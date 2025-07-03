@extends('admin-main.layouts.fullwidth')

@section('content')
<div class="col-lg-6 col-md-12 col-sm-12 mx-auto align-self-center">
    <div class="login-form">
        <div class="text-center">
            <h3 class="title">Sign In</h3>
            <p>Sign in to your account to start using W3CRM</p>
        </div>

        {{-- Display error message --}}
        @if (session('message'))
            <div class="alert alert-danger mt-2">
                {{ session('message') }}
            </div>
        @endif

        {{-- Display all validation errors --}}
        @if ($errors->any())
            <div class="alert alert-danger mt-2">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="mb-1 text-dark"> user Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="mb-4 position-relative">
                <label class="mb-1 text-dark">Password</label>
                <input type="password" name="password" id="dz-password" class="form-control" required>
            </div>

            <div class="form-row d-flex justify-content-between mt-4 mb-2">
                <div class="mb-4">
                    <a href="{{ url('page-forgot-password') }}" class="btn-link text-primary">Forgot Password?</a>
                </div>
            </div>

            <div class="text-center mb-4">
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>

            <h6 class="login-title"><span>Or continue with</span></h6>

            <div class="mb-3">
                <ul class="d-flex align-self-center justify-content-center">
                    <li><a target="_blank" href="https://www.facebook.com/" class="fab fa-facebook-f btn-facebook"></a></li>
                    <li><a target="_blank" href="https://www.google.com/" class="fab fa-google-plus-g btn-google-plus mx-2"></a></li>
                    <li><a target="_blank" href="https://www.linkedin.com/" class="fab fa-linkedin-in btn-linkedin me-2"></a></li>
                    <li><a target="_blank" href="https://twitter.com/" class="fab fa-twitter btn-twitter"></a></li>
                </ul>
            </div>

            <p class="text-center">Not registered?
                <a class="btn-link text-primary" href="{{ url('register') }}">Register</a>
            </p>
        </form>
    </div>
</div>

<div class="col-xl-6 col-lg-6">
    <div class="pages-left h-100">
        <div class="login-content">
            <a href="{{ url('index') }}"><img src="{{ asset('public/images/logo-full.png') }}" class="mb-3 logo-dark" alt=""></a>
            <a href="{{ url('index') }}"><img src="{{ asset('public/images/logi-white.png') }}" class="mb-3 logo-light" alt=""></a>
            <p>CRM dashboard uses line charts to visualize customer-related metrics and trends over time.</p>
        </div>
        <div class="login-media text-center">
            <img src="{{ asset('public/images/login.png') }}" alt="">
        </div>
    </div>
</div>
@endsection
