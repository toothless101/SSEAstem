@extends('layout.app')
@section('title', 'SSEAS | Login')
@section('content')

<link rel="stylesheet" href="{{ asset('css/admin/auth/log-in.css')}}">

<div class="container">
    <!-- Left Section -->
    <div class="left">
        <h1>TAGUM CITY COLLEGE OF SCIENCE AND TECHNOLOGY <br> FOUNDATION, INC.</h1>
        
        <!-- School Logos -->
        <div class="school_logos">
            <div class="school_logo">
                <img src="{{ asset('img/tccstfi-logo.png') }}" alt="tccstfi_logo">
            </div>
            {{-- <div class="ssc_logo">
                <img src="{{ asset('img/ssc-logo.png') }}" alt="ssc_logo">
            </div> --}}
        </div>
        
    </div>

    <!-- Right Section -->
    <div class="right">
        <h1>Login</h1>
        <div class="underline"></div>

        <!-- Login Message -->
        <div class="createmsg">
            <h2>Login as Admin user</h2>
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{route('login_admin')}}">
            @csrf

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Username Field -->
            <div class="form-group mb-4 position-relative">
                <input type="text" id="username" name="username" autofocus required>
                <label for="username">Username</label>
                <i class="fas fa-user icon"></i>
                @error('username')
                    <span class="text-danger">{{ $message }}</span>     
                @enderror
            </div>

            <!-- Password Field -->
            <div class="form-group mb-4 position-relative">
                <input type="password" id="password" name="password" required>
                <label for="password">Password</label>
                <i class="fas fa-lock icon"></i>

                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                 @enderror
            </div>


             <!-- Login Button -->
            <div class="log_btn">
                <button class="login_btn" id="login_btn">Login</button>
            </div>

        </form>

        {{-- <!-- Signup Prompt -->
        <div class="signup_btn">
            Don't have an account? 
            <a href="{{route('admin_register')}}">Sign Up</a>
        </div> --}}
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        const alertTime = document.querySelector('.alert');
        if(alertTime){
            setTimeout(() => {
                alertTime.style.display = 'none';
            }, 3000);//2 seconds
        }
    })
</script>
@endsection