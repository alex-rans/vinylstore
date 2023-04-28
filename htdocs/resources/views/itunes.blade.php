@extends('layouts.template')

@section('title', 'Welcome to The Vinyl Shop')

@section('main')
    <h1>{{$title}}</h1>
    <p>Last updated: {{$update}}</p>
    <div class="row">
    @foreach($songs as $song)
        <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
            <div class="card" data-id="{{ $song['id'] }}">
                <img class="card-img-top" src="{{ substr($song['artworkUrl100'],0, -13).'500x500bb.jpg' }}" data-src="{{ $song['artworkUrl100'] }}" alt="{{  $song['artistName'] }} - {{ $song['name'] }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $song['artistName'] }}</h5>
                    <p class="card-text">{{ $song['name'] }}</p>
                </div>
                <div class="card-footer">
                    <p>Genre: {{ $song['genres'][0]['name'] }}</p>
                    <div class="d-flex">
                    <p class="mr-1">Artist url: </p><a href="{{$song['artistUrl']}}">{{$song['artistName']}}</a></div>
                </div>
            </div>
        </div>
    @endforeach
    </div>
@endsection
