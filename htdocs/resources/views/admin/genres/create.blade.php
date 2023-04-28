@extends('layouts.template')

@section('title', 'Create new genre')

@section('main')
    <h1>Create new genre</h1>
    <form action="/admin/genres" method="post">
        @include('admin.genres.form')
    </form>
@endsection
