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
                <h1 class="auth-form-title" style="padding: 10px 0">Register</h1>
            </div>
            <div class="auth-form-container">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="my-form-group">
                        <label for="name">Name</label>
                        <input id="name" type="text" name="name" required autocomplete="name" autofocus
                            value="{{ old('name') }}" class="auth-input" />
                    </div>
                    <div class="my-form-group">
                        <label for="email">Email Address</label>
                        <input id="email" type="email" name="email" required autocomplete="email" autofocus
                            value="{{ old('email') }}" class="auth-input" />
                    </div>
                    <div class="my-form-group">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password" autofocus
                            class="auth-input" />
                    </div>
                    <div class="my-form-group">
                        <label for="password-confirm">Confirm Password</label>
                        <input id="password-confirm" type="password" name="password_confirmation" required
                            autocomplete="new-password" autofocus class="auth-input" />
                    </div>
                    <div class="auth-button-container">
                        <button type="submit" class="auth-button">Register</button>
                    </div>
                </form>
                <div class="auth-question" style="padding: 20px 0">
                    <h4 style="padding: 5px 0">
                        Already have an account ? <a href="{{ route('login') }}">Login</a>
                    </h4>
                </div>
            </div>
        </div>
    </div>
@endsection
