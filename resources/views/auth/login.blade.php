@extends('layouts.app')

@section('content')
<section style="min-height: calc(100vh - 200px); display: flex; align-items: center; padding: 60px 0;">
    <div class="container">
        <div style="max-width: 450px; margin: 0 auto; background: white; padding: 48px; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
            <h1 style="font-size: 32px; font-weight: 700; margin-bottom: 8px; text-align: center; color: #1f2937;">Welcome Back</h1>
            <p style="text-align: center; color: #6b7280; margin-bottom: 32px;">Login to your account</p>

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div style="margin-bottom: 24px;">
                    <label for="email" style="display: block; font-weight: 500; margin-bottom: 8px; color: #374151;">Email Address</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        required
                        autofocus
                        style="width: 100%; padding: 12px 16px; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 16px; transition: border-color 0.3s;"
                        onfocus="this.style.borderColor='#ec4899'"
                        onblur="this.style.borderColor='#e5e7eb'"
                    >
                </div>

                <div style="margin-bottom: 24px;">
                    <label for="password" style="display: block; font-weight: 500; margin-bottom: 8px; color: #374151;">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        required
                        style="width: 100%; padding: 12px 16px; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 16px; transition: border-color 0.3s;"
                        onfocus="this.style.borderColor='#ec4899'"
                        onblur="this.style.borderColor='#e5e7eb'"
                    >
                </div>

                <div style="display: flex; align-items: center; margin-bottom: 24px;">
                    <input 
                        type="checkbox" 
                        id="remember" 
                        name="remember"
                        style="width: 18px; height: 18px; margin-right: 8px; cursor: pointer;"
                    >
                    <label for="remember" style="color: #6b7280; cursor: pointer;">Remember me</label>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; font-size: 16px; padding: 14px;">
                    Login
                </button>
            </form>

            <p style="text-align: center; margin-top: 24px; color: #6b7280;">
                Don't have an account? 
                <a href="{{ route('register') }}" style="color: #ec4899; text-decoration: none; font-weight: 500;">Sign up</a>
            </p>

            <p style="text-align: center; margin-top: 16px;">
                <a href="/" style="color: #6b7280; text-decoration: none;">← Back to home</a>
            </p>
        </div>
    </div>
</section>
@endsection

