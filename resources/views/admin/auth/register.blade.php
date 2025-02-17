@extends('layout.app')
@section('title', 'SSEA | Register')
@section('content')

<!--REGISTER CSS-->
<link rel="stylesheet" href="{{asset('css/admin/auth/register.css')}}">

<div class="container signup-container">

    <!--LEFT Section-->
    <div class="left">
        <h1>Sign Up</h1>
        <div class="underline"></div>

        <!-- Signup Message -->
        <div class="createmsg">
            <h2>Create your Account</h2>
        </div>

        <!--SIGN UP FORM-->

        <form method="POST" action="{{route('register_admin')}}">
            @csrf
            
            <div class="form-group mb-4 position-relative">
                <input type="text" id="firstname" name="firstname" autofocus>
                <label for="firstname">First Name</label>
                <i class="fas fa-user icon"></i>

                @error('firstname')
                    <span class="text-danger">{{ $message }}</span>     
                @enderror
            </div>

            <div class="form-group mb-4 position-relative">
                <input type="text" id="lastname" name="lastname" autofocus>
                <label for="lastname">Last Name</label>
                <i class="fas fa-user icon"></i>

                @error('lastname')
                    <span class="text-danger">{{ $message }}</span>     
                @enderror
            </div>

            <div class="form-group mb-4 position-relative">
                <input type="text" id="email" name="email" autofocus>
                <label for="fullname">Email</label>
                <i class="fas fa-envelope icon"></i> 

                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

            </div>

            <!-- Username Field -->
            <div class="form-group mb-4 position-relative">
                <input type="text" id="username" name="username">
                <label for="username">Username</label>
                <i class="fas fa-user icon"></i>

                @error('username')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

            </div>

            <!-- Password Field -->
            <div class="form-group mb-4 position-relative">
                <input type="password" id="password" name="password">
                <label for="password">Password</label>
                <i class="fas fa-lock icon"></i>

                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="signup_button">
                <button type="submit" class="s-btn">Sign Up</button>
            </div>
        </form>

        <!-- Login Prompt -->
        <div class="login_button">
            Already have an account? 
            <a href="{{route('admin_login')}}">Login</a>
        </div>
    </div>

    <!--RIght Section-->
    <div class="right">
        <h1>TAGUM CITY COLLEGE OF SCIENCE AND TECHNOLOGY <br> FOUNDATION, INC.</h1>

        <!-- School Logos -->
        <div class="school_logos">
            <div class="school_logo">
                <img src="{{ asset('img/tccstfi-logo.png') }}" alt="tccstfi_logo">
            </div>
            {{-- <div class="ssc_logo">
                <img src="{{ asset('img/ssc-logo.png') }}" alt="tccstfi_logo">
            </div> --}}
        </div>
    </div>
</div>
@endsection