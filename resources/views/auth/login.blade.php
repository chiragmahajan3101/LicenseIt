@extends('layouts.app')

@section('title')
Login | LicenseIt
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="container-login-left bg-secondary"></div>
            <div class="container-login-left"></div>
            <div class="container-login d-flex flex-row justify-content-between reveal animate__pulse animate__animated">
                <div class="display-image animate__fadeIn animate__animated animate__slow">
                    <img src="{{asset('images/Auth/login.png')}}" class="image-display" width="450em" alt="">
                </div>
                <div class="animate__fadeIn animate__animated animate__slow flex-column">
                    <div class="intro-text">
                    </div>
                    <div class="inputs">
                        <form method="POST" action="{{ route('login') }}">
                        @csrf
                            <div class="email-input form-group-row">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="@error('email') is-invalid @enderror" id="email" placeholder="Enter your email address"  value="{{ old('email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="password-input  form-group-row">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="@error('password') is-invalid @enderror" placeholder="Enter your Password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-md-7">
                                    <div class="form-check pt-4">
                                        <input class="form-check-input pt-5" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember" style="padding: 0;">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="d-block mx-auto styled-btn styled-rounded text-muted float-left border border-dark btn-box" >
                                <span class="styled-button-text" id="my-btn">Log in</span>
                            </button>
                            <div class="form-group-row mt-5">
                                    <a class="btn btn-link" href="{{ route('password.reset') }}">
                                        Change Your Password?
                                    </a>
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
        strings: ["<h1>First sentence.</h1>", "<h1>Log in</h1>", "<h1>Manage License</h1>"],
        typeSpeed: 80,
        startDelay: 1,
        backSpeed: 40,
        loop: true,
        showCursor: false
        });
</script>
@endsection
