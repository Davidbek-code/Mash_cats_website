@extends('layouts.main')

@section('title', 'Вход в аккаунт')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/registration.css') }}">
@endpush

@section('content')
<div class="registartion_form">
    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="input_container">
            <p class="input_title">Email</p>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus class="input">
        </div>

        <div class="input_container">
            <p class="input_title">Пароль</p>
            <input type="password" name="password" required class="input">
        </div>

        <button type="submit" class="btn_register">Войти</button>
    </form>
</div>
<a class="to_login_link" href="{{ route('password.request') }}">Забыли пароль?</a>
<a class="to_forgot_link" href="{{ route('register') }}">Нет аккаунта?</a>
@endsection
