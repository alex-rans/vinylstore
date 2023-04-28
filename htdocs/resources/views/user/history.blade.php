@extends('layouts.template')

@section('title', 'Order History')

@section('main')
    <h1>Order History</h1>
    @include('shared.alert')
    @if($orders->isEmpty())
        <div class="alert alert-primary">
            You haven't placed any orders yet.
        </div>
    @else
        @foreach($orders as $order)
            <div class="card mb-3">
                <h5 class="card-header">
                    <b>Order date</b>: {{ $order->created_at }}
                </h5>
                <div class="card-body">
                    @foreach($order->orderlines as $orderline)
                        <div class="d-flex">
                            <div>
                                <img class="img-thumbnail cover width-80" src="/assets/vinyl.png"
                                     data-src="{{ $orderline->cover }}"
                                     alt="{{ $orderline->title }}">
                                <p class="text-center mt-2">€ {{ $orderline->total_price }}</p>
                            </div>
                            <p class="px-3">
                                <b>{{ $orderline->artist . ' - ' . $orderline->title  }}</b><br>
                                <span class="text-black-50">Quantity:{{ $orderline->quantity }} </span>
                            </p>
                        </div>
                    @endforeach
                </div>
                <div class="card-footer">
                    <b>Total price</b>: € {{ $order->total_price }}
                </div>
            </div>
        @endforeach
    @endif
@endsection
@section('script_after')
    <script>
        $(function () {
            $('.cover').each(function () {
                $(this).attr('src', $(this).data('src'));
            });
        });
    </script>
@endsection
