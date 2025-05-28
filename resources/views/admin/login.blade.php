@extends('layouts.app')

@section('title', 'Login Admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('style/main.css') }}">
<style>
    body, html {
        height: 100%;
        margin: 0;
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(to right, #f0fdf4, #d1f2eb);
    }

    .login-container {
        display: flex;
        height: 100vh;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .login-wrapper {
        display: flex;
        width: 900px;
        max-width: 100%;
        border-radius: 16px;
        overflow: hidden;
        background: #ffffff;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
    }

    .login-image {
        flex: 1;
        min-height: 500px;
        background: linear-gradient(135deg, #2ECC71, #A3E4D7);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-image img {
        width: 80%;
        max-height: 80%;
        object-fit: contain;
        filter: drop-shadow(0 4px 10px rgba(0,0,0,0.1));
    }

    .login-form-container {
        flex: 1;
        padding: 50px 40px;
        position: relative;
        z-index: 2;
        background-color: #ffffff;
    }

    .login-form-container h2 {
        margin-bottom: 30px;
        color: #2ECC71;
        font-weight: 700;
        font-size: 2.2rem;
        text-align: center;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: #333;
    }

    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 14px 18px;
        border: none;
        border-radius: 10px;
        background: #f0f0f3;
        box-shadow: inset 3px 3px 6px #d1d9e6,
                    inset -3px -3px 6px #ffffff;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    input[type="text"]:focus,
    input[type="password"]:focus {
        outline: none;
        background: #e8f8f5;
        box-shadow: 0 0 0 3px rgba(46, 204, 113, 0.3);
    }

    .btn-login {
        width: 100%;
        background: linear-gradient(to right, #2ECC71, #27AE60);
        color: white;
        padding: 14px 0;
        border: none;
        border-radius: 10px;
        font-size: 1.1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(46, 204, 113, 0.3);
    }

    .error-messages {
        background-color: #eafaf1;
        color: #27ae60;
        border-left: 4px solid #2ECC71;
        border-radius: 8px;
        padding: 10px 15px;
        margin-bottom: 20px;
        font-size: 0.9rem;
        box-shadow: 0 4px 6px rgba(39, 174, 96, 0.1);
    }
</style>
@endpush

@section('content')
<div class="login-container">
    <div class="login-wrapper">
        <div class="login-image">
            <img src="/images/logo.png" alt="Login Image">
        </div>
        <div class="login-form-container">
            <h2>Masuk Admin</h2>
            @if ($errors->any())
                <div class="error-messages">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('admin.login.post') }}">
                @csrf
                <div class="form-group">
                    <label for="username">Nama Pengguna</label>
                    <input type="text" id="username" name="username" required autofocus placeholder="Masukkan nama pengguna">
                </div>
                <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <input type="password" id="password" name="password" required placeholder="Masukkan kata sandi">
                </div>
                <button type="submit" class="btn-login">Masuk</button>
            </form>
        </div>
    </div>
</div>
@endsection
