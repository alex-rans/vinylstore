@extends('layouts.template')

@section('title', "Edit record: $record->artist - $record->title")

@section('main')
    <h1>Update record</h1>
    <form action="/admin/records/{{ $record->id }}" method="post">
        @method('put')
        @include('admin.records.form')
    </form>
@endsection

@section('script_after')
    @include('admin.records.script')
@endsection
