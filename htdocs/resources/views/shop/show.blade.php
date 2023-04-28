@extends('layouts.template')

@section('title', 'Record')

@section('main')
    <h1>{{$record->title}}</h1>
    @include('shared.alert')
    @auth()
        @if(auth()->user()->admin)
            <div class="alert alert-primary">
                <a href="/admin/records/create" class="btn btn-success">
                    <i class="fas fa-plus-circle mr-1"></i>New record
                </a>
                <a href="/admin/records/{{ $record->id }}/edit" class="btn btn-primary">
                    <i class="fas fa-edit mr-1"></i>Edit record
                </a>
                <a href="#!" class="btn btn-danger" id="deleteRecord">
                    <i class="fas fa-trash mr-1"></i>Delete record
                </a>
            </div>
        @endif
    @endauth
    <div class="row">
        <div class="col-sm-4 text-center">
            <img class="img-thumbnail" id="cover" src="/assets/vinyl.png" data-src="{{ $record->cover }}">
            <p>
                <a href="/basket/add/{{ $record->id }}" class="btn {{ $record->btnClass }} btn-sm btn-block mt-3
                    {{ $record->stock == 0 ? 'disabled' : '' }}">
                    <i class="fas fa-cart-plus mr-3"></i>Add to cart
                </a>
            </p>

            <p class="text-left">Genre: {{ $record->genreName }}<br>
                Stock: {{ $record->stock }}<br>
                Price: € {{ $record->price }}</p>
        </div>
        <div class="col-sm-8">
            <table class="table table-sm">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Track</th>
                    <th>Length</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tracks as $track)
                    <tr>
                        <td>{{ $track['position'] }}</td>
                        <td>{{ $track['title'] }}</td>
                        <td>{{ $track['length'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script_after')
    <script>
        // Replace vinyl.png with real cover
        $('#cover').attr('src', $('#cover').data('src'));

        // Delete this record
        @auth()
        @if(auth()->user()->admin)
        $('#deleteRecord').click(function () {
            let id = '{{ $record->id }}';
            console.log(`delete record ${id}`);
            // Show Noty
            let modal = new Noty({
                text: '<p>Delete the record <b>{{ $record->title }}</b>?</p>',
                buttons: [
                    Noty.button('Delete record', 'btn btn-danger', function () {
                        // Delete record and close modal
                        let pars = {
                            '_token': '{{ csrf_token() }}',
                            '_method': 'delete'
                        };
                        $.post(`/admin/records/${id}`, pars, 'json')
                            .done(function (data) {
                                console.log('data', data);
                                // Show toast
                                VinylShop.toast({
                                    type: data.type,
                                    text: data.text
                                });
                                // After 2 seconds, redirect to the public master page
                                setTimeout(function () {
                                    $(location).attr('href', '/shop'); // jQuery
                                    // window.location = '/shop'; // JavaScript
                                }, 2000);
                            })
                            .fail(function (e) {
                                console.log('error', e);
                            });
                        modal.close();
                    }),
                    Noty.button('Cancel', 'btn btn-secondary ml-2', function () {
                        modal.close();
                    })
                ]
            }).show();
        });
        @endif
        @endauth
    </script>
@endsection
