@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="container-login-left bg-secondary"></div>
            <div class="container-login-left"></div>
            <div class="container-login d-flex flex-row justify-content-between reveal animate__pulse animate__animated">
                <div class="display-image animate__fadeIn animate__animated animate__slow">
                    <img src={{asset('images/Auth/reset_password.png')}} class="image-display" width="450em" alt="">
                </div>
                <div class="animate__fadeIn animate__animated animate__slow flex-column">
                    <div class="intro-text">
                    </div>
                    <div class="inputs">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <div class="email-input form-group-row">
                                <label for="email" >{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" placeholder="Enter your email address" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="password-input form-group-row">
                                <label for="old-password">Old Password</label>
                                <input id="old-password" type="password" class="@error('old_password') is-invalid @enderror" placeholder="Enter your old password" name="old_password" required autocomplete="old-password">
                                @error('old_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="password-input form-group-row">
                                <label for="password">{{ __('New Password') }}</label>
                                <input id="password" type="password" class="@error('password') is-invalid @enderror" placeholder="Enter your new password"  name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="password-input form-group-row">
                                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" placeholder="Confirm your new password" name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <div class="form-group-row">
                                <button type="submit" class="d-block mx-auto styled-btn styled-rounded text-muted float-left border border-dark btn-box" >
                                    <span class="styled-button-text" id="my-btn">{{ __('Reset Password') }}</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="container-login-right bg-secondary"></div>
            <div class="container-login-right"></div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    new RevealScroll($(".reveal"), "60%");
    var typed = new Typed('.intro-text', {
        strings: ["<h1>First sentence.</h1>", "<h1>Rest Password</h1>", "<h1>Check License</h1>"],
        typeSpeed: 80,
        startDelay: 1,
        backSpeed: 40,
        loop: true,
        showCursor: false
        });
</script>
@endsection
