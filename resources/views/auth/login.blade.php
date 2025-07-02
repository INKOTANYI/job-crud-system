@extends('layouts.app')

@section('content')
<div class="login-logo">
    <a href="{{ url('/') }}">JobRwanda</a>
</div>
<div class="card">
    <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="input-group mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember">Remember Me</label>
                    </div>
                </div>
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </div>
            </div>
            <p class="mb-1">
                <a href="{{ route('password.request') }}" class="text-center">Forgot Your Password?</a>
            </p>
            <p class="mb-0">
                <a href="{{ route('register') }}" class="text-center">Register a new account</a>
            </p>
        </form>
    </div>
</div>
@endsection
