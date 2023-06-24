@extends('layout.admin-layout')

@section('fillspace')
<div class="register-container">
    <h1>Register</h1>

    <form method="post" action="{{ route('candidateRegister') }}">
        @csrf
        <div class="form-group">
            <input type="text" name="name" placeholder="Enter your name">
            @error('name')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <input type="email" name="email" placeholder="Enter your email">
            @error('email')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Enter your password">
            @error('password')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <input type="password" name="password_confirm" placeholder="Confirm your password">
            @error('password_confirm')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label>
                <input type="radio" name="is_admin" value="1"> Admin
            </label>
            <label>
                <input type="radio" name="is_admin" value="0" checked> Candidate
            </label>
        </div>
        <button type="submit" class="btn">Register</button>
    </form>

    @if(Session::has('success'))
        <p class="success-message">{{ Session::get('success') }}</p>
    @endif
</div>

@endsection
