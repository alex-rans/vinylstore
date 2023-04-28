@extends('layouts.template')

@section('title', 'Update password')

@section('main')
    <h1>New password</h1>
    @include('shared.alert')
    <form action="/user/password" method="post">
        @csrf
        <div class="form-group">
            <label for="current_password">Current password</label>
            <input type="password" name="current_password" id="current_password"
                   class="form-control @error('current_password') is-invalid @enderror"
                   placeholder="Current password"
                   value="{{ old('current_password') }}"
                   required>
            @error('current_password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">New password</label>
            <input type="password" name="password" id="password"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="New password"
                   value="{{ old('password') }}"
                   minlength="8"
                   required>
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm new password</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                   class="form-control"
                   placeholder="Confirm new password"
                   value="{{ old('password_confirmation') }}"
                   minlength="8"
                   required>
        </div>
        <button type="submit" class="btn btn-success">Update password</button>
    </form>
@endsection
