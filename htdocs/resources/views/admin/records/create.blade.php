@extends('layouts.template')

@section('title', 'Create new record')

@section('main')
    <h1>Create new record</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/admin/records" method="post">
        @include('admin.records.form')
    </form>
@endsection
@section('script_after')
    @include('admin.records.script')
@endsection
