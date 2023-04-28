@extends('layouts.template')

@section('title', 'Edit genre')

@section('main')
    <h1>Edit genre: {{ $genre->name }}</h1>
    <form action="/admin/genres/{{ $genre->id }}" method="post">
        @method('put')
        @include('admin.genres.form')
    </form>
@endsection
