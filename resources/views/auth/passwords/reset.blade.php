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
                <h1 class="auth-form-title" style="padding: 10px 0">Reset Password</h1>
            </div>
            <div class="auth-form-container">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="my-form-group">
                        <label for="email">Email Address</label>
                        <input id="email" type="email" name="email" required autocomplete="email" autofocus
                            value="{{ $email ?? old('email') }}" class="auth-input" />
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
                        <button type="submit" class="auth-button">Reset Password</button>
                    </div>
                </form>
                <div class="auth-question">
                    <h4><a href="{{ route('login') }}"><span class="arrow-back-form">&larr;</span> Go Back</a></h4>
                </div>
            </div>
        </div>
    </div>
@endsection
