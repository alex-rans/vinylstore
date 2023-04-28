<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Order;
use App\Orderline;
use App\User;
use Auth;
use Cart;
//use http\Exception;
use Illuminate\Http\Request;
use Json;
use Mail;
use Omnipay\Omnipay;

class HistoryController extends Controller
{
    private $gateway;
    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true); //set it to 'false' when go live
    }
    // Show the full order history
    public function index ()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with('orderlines')
            ->orderBy('created_at', 'desc')
            ->get();
        $result = compact('orders');
        Json::dump($result);
        return view('/user/history', $result);
    }
    public function charge(Request $request)
    {
        if($request->input('submit'))
        {
                $response = $this->gateway->purchase(array(
                    'amount' => Cart::getTotalPrice(),
                    'items' => array(array(),),
                    'currency' => env('PAYPAL_CURRENCY'),
                    'returnUrl' => url('paymentsuccess'),
                    'cancelUrl' => url('paymenterror'),
                ))->send();
                foreach (Cart::getRecords() as $record) {
                    $response['items'][] = array (
                        'name' => $record['artist'],
                        'price' => $record['price'],
                        'description' => $record['title'],
                        'quantity' => $record['qty']
                    );
                }

                if ($response->isRedirect()) {
                    $response->redirect(); // this will automatically forward the customer
                } else {
                    // not successful
                    return $response->getMessage();
                }
        }
    }

    public function success(Request $request)
    {
        // Once the transaction has been approved, we need to complete it.
        if ($request->input('paymentId') && $request->input('PayerID'))
        {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id'             => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));
            $response = $transaction->send();

            if ($response->isSuccessful())
            {
                // The customer has successfully paid.
                $arr_body = $response->getData();

                // Insert transaction data into the database
                $order = new Order();
                $order->user_id = auth()->id();
                $order->payment_id = $arr_body['id'];
                $order->payer_id = $arr_body['payer']['payer_info']['payer_id'];
                $order->payer_email = $arr_body['payer']['payer_info']['email'];
                $order->amount = $arr_body['transactions'][0]['amount']['total'];
                $order->currency = env('PAYPAL_CURRENCY');
                $order->payment_status = $arr_body['state'];
                $order->save();

                $order_id = $order->id;
                // Loop over the records array in the cart and save them to the orderlines table
                foreach (Cart::getRecords() as $record) {
                    $orderline = new Orderline();
                    $orderline->order_id = $order_id;
                    $orderline->artist = $record['artist'];
                    $orderline->title = $record['title'];
                    $orderline->cover = $record['cover'];
                    $orderline->total_price = $record['price'];
                    $orderline->quantity = $record['qty'];
                    $orderline->save();
                }
                // Empty the cart
                Cart::empty();
                return redirect('/user/history');

            } else {
                return $response->getMessage();
            }
        } else {
            return 'Transaction is declined';
        }
    }

    // Add data from cart to the database
    public function checkout()
    {
        // Create a new order and save it to the orders table
        $order = new Order();
        $order->user_id = auth()->id();
        $order->total_price = Cart::getTotalPrice();
        $order->save();
        // Retrieve the id of the last inserted order
        $order_id = $order->id;
        // Loop over the records array in the cart and save them to the orderlines table
        foreach (Cart::getRecords() as $record) {
            $orderline = new Orderline();
            $orderline->order_id = $order_id;
            $orderline->artist = $record['artist'];
            $orderline->title = $record['title'];
            $orderline->cover = $record['cover'];
            $orderline->total_price = $record['price'];
            $orderline->quantity = $record['qty'];
            $orderline->save();
        }
        // Empty the cart
        Cart::empty();
        // Redirect to the history page
        $message = 'Thank you for your order.<br>The records will be delivered as soon as possible.';
        $this->confirmEmail();
        session()->flash('success', $message);
        return redirect('/user/history');
    }
    private function confirmEmail()
    {
        // construct the mail message
        $message = '<p>Thank you for your order.<br>The records will be delivered as soon as possible.</p>';
        $message .= '<ul>';
        foreach (Cart::getRecords() as $record) {
            $message .= "<li>{$record['qty']} x {$record['artist']} - {$record['title']}</li>";
        }
        $message .= '</ul>';

        // Get all admins
        $admins = User::where('admin', true)->select('name', 'email')->get();

        $email = new OrderMail($message);
        Mail::to(Auth::user())
            ->cc($admins)
            ->send($email);
    }
}
