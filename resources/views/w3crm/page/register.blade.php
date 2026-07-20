@extends('admin-main.layouts.fullwidth')
@section('content')
<div class="col-lg-6 col-md-12 col-sm-12 mx-auto align-self-center">
    <div class="login-form">
        <div class="text-center">
            <h3 class="title">Create Your Account</h3>
            <p>Register to start using W3CRM</p>
        </div>

        {{-- Error messages --}}
        @if (session('message'))
            <div class="alert alert-danger mt-2">
                {{ session('message') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger mt-2">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ url('admin/register') }}" method="POST">
            @csrf

            <!-- COMPANY DETAILS -->
            <h6 class="fw-bold mt-4 mb-3 text-primary">Company Details</h6>

            <div class="mb-3">
                <label class="mb-1 text-dark">Company Name</label>
                <input type="text" name="company_name" class="form-control"
                       value="{{ old('company_name') }}" required>
            </div>

            <div class="mb-3">
                <label class="mb-1 text-dark">Company Email</label>
                <input type="email" name="company_email" class="form-control"
                       value="{{ old('company_email') }}" required>
            </div>

            <div class="mb-4">
                <label class="mb-1 text-dark">Company Phone</label>
                <input type="text" name="company_phone" class="form-control"
                       value="{{ old('company_phone') }}" required>
            </div>

            <!-- USER DETAILS -->
            <h6 class="fw-bold mt-4 mb-3 text-primary">User Details</h6>

            <div class="mb-3">
                <label class="mb-1 text-dark">Username</label>
                <input type="text" name="username" class="form-control"
                       value="{{ old('username') }}" required>
            </div>

            <div class="mb-3">
                <label class="mb-1 text-dark">Email</label>
                <input type="email" name="email" class="form-control"
                       value="{{ old('email') }}" required>
            </div>

            <div class="mb-4">
                <label class="mb-1 text-dark">Phone</label>
                <input type="text" name="phone" class="form-control"
                       value="{{ old('phone') }}" required>
            </div>

            <div class="mb-3 position-relative">
                <label class="mb-1 text-dark">Password</label>
                <input type="password" name="password"
                       class="form-control" required>
            </div>

            <div class="mb-4 position-relative">
                <label class="mb-1 text-dark">Confirm Password</label>
                <input type="password" name="password_confirmation"
                       class="form-control" required>
            </div>


            <div class="text-center mb-4">
                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>

            <p class="text-center">
                Already have an account?
                <a class="btn-link text-primary" href="{{ url('/') }}">Sign In</a>
            </p>

        </form>
    </div>
</div>

<!-- RIGHT SIDE IMAGE + TEXT -->
<div class="col-xl-6 col-lg-6">
    <div class="pages-left h-100">
        <div class="login-content">
            <a href="{{ url('index') }}">
                <img src="{{ asset('public/images/logo-full.png') }}" class="mb-3 logo-dark" alt="">
            </a>
            <a href="{{ url('index') }}">
                <img src="{{ asset('public/images/logi-white.png') }}" class="mb-3 logo-light" alt="">
            </a>
            <p>CRM dashboard uses line charts to visualize 
               customer-related metrics and trends over time.</p>
        </div>

        <div class="login-media text-center">
            <img src="{{ asset('public/images/login.png') }}" alt="">
        </div>
    </div>
</div>
@endsection
