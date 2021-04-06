@extends('layouts.app')

@section('content')
    <div class="auth-container">
        <div id="auth-left">
            <h1>Welcome to Monday</h1>
            <div class="auth-monday-desc">
                <h3>> Let's make project more amazing</h3>
                <h3>> Let's build a cool things together</h3>
                <h3>> Let's grow up</h3>
            </div>
        </div>
        <div id="auth-right">
            <div>
                <h1 class="auth-form-title">Login</h1>
            </div>
            <div class="auth-form-container">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="my-form-group">
                        <label for="email">Email Address</label>
                        <input id="email" type="email" name="email" required autocomplete="email" autofocus
                            value="{{ old('email') }}" class="auth-input" />
                    </div>
                    <div class="my-form-group">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            autofocus class="auth-input" />
                    </div>
                    <div class="my-form-group">
                        <div class="auth-remember">
                            <input class="auth-form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }} />

                            <label class="form-check-label" for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <div class="auth-button-container">
                        <button type="submit" class="auth-button">Login</button>
                    </div>
                </form>
                <div class="auth-question">
                    <h4><a href="{{ route('password.request') }}">Forgot Password ?</a></h4>
                    <h4>
                        Don't have an account ? <a href="{{ route('register') }}">Register</a>
                    </h4>
                </div>
            </div>
        </div>
    </div>
@endsection
