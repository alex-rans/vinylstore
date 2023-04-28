<?php

namespace App\Http\Controllers;

use App\Record;
use Cart;
use Illuminate\Http\Request;
use Json;

class BasketController extends Controller
{
    public function index()
    {
        $records = Record::orderBy('title')->take(3)->get();
        $result = compact('records');
        Json::dump($result);
        return view('basket', $result);
    }

    public function addToCart($id)
    {
        $record = Record::findOrFail($id);
        Cart::add($record);
        session()->flash('success', "The record <b>$record->title</b> from <b>$record->artist</b> has been added to your basket");
        return back();
    }

    public function deleteFromCart($id)
    {
        $record = Record::findOrFail($id);
        Cart::delete($record);
        return back();
    }

    public function emptyCart()
    {
        Cart::empty();
        return redirect('basket');
    }
}
