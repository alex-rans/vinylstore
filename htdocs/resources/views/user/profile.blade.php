@extends('layouts.template')

@section('title', 'Update profile')

@section('main')
    <h1>Update profile</h1>
    @include('shared.alert')
    <form action="/user/profile" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name"
                   class="form-control @error('name') is-invalid @enderror"
                   placeholder="Your name"
                   value="{{ old('name', auth()->user()->name ) }}"
                   required>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email"
                   class="form-control @error('email') is-invalid @enderror"
                   placeholder="Your email"
                   vvalue="{{ old('email', auth()->user()->email) }}"
                   required>
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Update Profile</button>
    </form>
@endsection
