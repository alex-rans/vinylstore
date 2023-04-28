@extends('layouts.template')

@section('title', 'Your Basket')

@section('main')
    <h1>Basket</h1>
    @if( Cart::getTotalQty() == 0)
        <div class="alert alert-primary">
            Your basket is empty.
        </div>
    @else
        @guest()
            <div class="alert alert-primary">
                You must be <a href="/login"><b>logged in</b></a> to checkout
            </div>
        @endguest
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th class="width-50">Qty</th>
                    <th class="width-80">Price</th>
                    <th class="width-80"></th>
                    <th>Record</th>
                    <th class="width-120"></th>
                </tr>
                </thead>
                <tbody>
                @foreach(Cart::getRecords() as $record)
                    <tr>
                        <td>{{ $record['qty'] }}</td>
                        <td>€&nbsp;{{ $record['price'] }}</td>
                        <td>
                            <img class="img-thumbnail cover" src="/assets/vinyl.png"
                                 data-src="{{ $record['cover'] }}"
                                 alt="{{ $record['title'] }}">
                        </td>
                        <td>
                            {{ $record['artist'] . ' - ' . $record['title']  }}
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="/basket/delete/{{ $record['id'] }}" class="btn btn-outline-secondary">-1</a>
                                <a href="/basket/add/{{ $record['id'] }}" class="btn btn-outline-secondary">+1</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <p><a href="/basket/empty" class="btn btn-sm btn-outline-danger">Empty your basket</a></p>
                    </td>
                    <td>
                        <p><b>Total</b>: €&nbsp;{{ Cart::getTotalPrice() }}</p>
                        @auth()
                            <form action="/user/charge" method="post">
                                <input type="text" name="amount" />
                                {{ csrf_field() }}
                                <input type="submit" name="submit" value="Pay Now">
                            </form>
{{--                            <p><a href="/user/checkout" class="btn btn-sm btn-outline-success">Checkout</a></p>--}}
{{--                            <div id="paypal-button-container"></div>--}}
                        @endauth
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    @endif
@endsection
@section('script_after')
{{--    <script src="https://www.paypal.com/sdk/js?client-id=AQoY2kCk2uVCcC8ehZIVd3oalw8ugVRrpvT91BKUVIcmWRJaL06pxC0poBB1V-LjPiKhtDytZjve4YP5&currency=EUR"></script>--}}
{{--    <script>--}}
{{--        paypal.Buttons({--}}
{{--            // Sets up the transaction when a payment button is clicked--}}
{{--            createOrder: function(data, actions) {--}}
{{--                return actions.order.create({--}}
{{--                    purchase_units: [{--}}
{{--                        amount: {--}}
{{--                            currency_code: "EUR",--}}
{{--                            value: '{{ Cart::getTotalPrice() }}',--}}
{{--                            breakdown: {--}}
{{--                                item_total: {  /* Required when including the `items` array */--}}
{{--                                    "currency_code": "EUR",--}}
{{--                                    "value": "{{ Cart::getTotalPrice() }}"--}}
{{--                                }--}}
{{--                            }--}}
{{--                        },--}}
{{--                        items: [@foreach(Cart::getRecords() as $record){--}}
{{--                                name: "{{ $record['artist'] . ' - ' . $record['title']  }}", /* Shows within upper-right dropdown during payment approval */--}}
{{--                                description: "{{ $record['artist'] . ' - ' . $record['title'] . 'vinyl record' }}", /* Item details will also be in the completed paypal.com transaction view */--}}
{{--                            unit_amount: {--}}
{{--                                    currency_code: "EUR",--}}
{{--                                    value: "{{ $record['price'] }}"--}}
{{--                                },--}}
{{--                                quantity: "{{ $record['qty'] }}"--}}
{{--                            },@endforeach--}}
{{--                        ]--}}
{{--                    }]--}}
{{--                });--}}
{{--            },--}}
{{--            // Finalize the transaction after payer approval--}}
{{--            onApprove: function(data, actions) {--}}
{{--                return actions.order.capture().then(function(orderData) {--}}

{{--                    // Successful capture! For dev/demo purposes:--}}
{{--                    // console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));--}}
{{--                    // var transaction = orderData.purchase_units[0].payments.captures[0];--}}
{{--                    // alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');--}}
{{--                    $.ajax({--}}
{{--                        method: 'post',--}}
{{--                        url: '/user/checkout',--}}
{{--                        data: {--}}
{{--                            'fname':response.firstname,--}}
{{--                            'lname':response.lastname,--}}
{{--                            'email':response.email,--}}
{{--                            'phone':response.phone,--}}
{{--                            'address1':response.address1,--}}
{{--                            'address2':response.address2,--}}
{{--                            'city':response.city,--}}
{{--                            'state':response.state,--}}
{{--                            'country':response.country,--}}
{{--                            'payment_id':orderData.id,--}}
{{--                        }--}}
{{--                    })--}}
{{--                });--}}
{{--            }--}}
{{--        }).render('#paypal-button-container');--}}
{{--    </script>--}}
    <script>
        $(function () {
            $('.cover').each(function () {
                $(this).attr('src', $(this).data('src'));
            });
            $('tbody tr:not(:last-child) td').addClass('align-middle');
        });
    </script>
@endsection
