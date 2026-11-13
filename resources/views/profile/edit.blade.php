@extends('layouts.main')

@section('title', 'Личный кабинет')

@push('styles')
    <!-- Подключаем стили вашей формы, чтобы поля сразу выглядели красиво -->
    <link rel="stylesheet" href="{{ asset('css/registration.css') }}">
@endpush

@section('content')
    <div class="registartion_form" style="max-width: 600px; margin: 40px auto;">
        <h2 style="color: #FF9595;" >ЛИЧНЫЙ КАБИНЕТ</h2>
        <p style="margin-bottom: 20px;">Ваша роль в системе: <strong>{{ $user->role }}</strong></p>

        <!-- Сообщение об успешном сохранении -->
        @if (session('status') === 'profile-updated')
            <div style="color: green; margin-bottom: 15px;">Данные профиля успешно обновлены!</div>
        @endif
        @if (session('status') === 'password-updated')
            <div style="color: green; margin-bottom: 15px;">Пароль успешно изменён!</div>
        @endif

        <!-- Вывод ошибок валидации -->
        @if ($errors->any())
            <div style="color: red; margin-bottom: 15px;">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- 1. Форма редактирования личных данных -->
        <form method="POST" action="{{ route('profile.update') }}" style="margin-bottom: 40px;">
            @csrf
            @method('PATCH')

            <div class="input_container">
                <p class="input_title">Фамилия</p>
                <input type="text" name="surname" value="{{ old('surname', $user->surname) }}" required class="input">
            </div>

            <div class="input_container">
                <p class="input_title">Имя</p>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="input">
            </div>

            <div class="input_container">
                <p class="input_title">Отчество</p>
                <input type="text" name="patronymic" value="{{ old('patronymic', $user->patronymic) }}" class="input">
            </div>

            <div class="input_container">
                <p class="input_title">Телефон</p>
                <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}" required class="input">
            </div>

            <div class="input_container">
                <p class="input_title">Email</p>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="input">
            </div>

            <button type="submit" class="btn_register">Сохранить данные</button>
        </form>

        <hr style="margin: 30px 0;">

        <!-- 2. Форма смены пароля -->
        <h2 style="color: #FF9595;" >СМЕНА ПАРОЛЯ</h2>
        <form method="POST" action="{{ route('password.update') }}" style="margin-bottom: 40px;">
            @csrf
            @method('PUT')

            <div class="input_container">
                <p class="input_title">Текущий пароль</p>
                <input type="password" name="current_password" required class="input">
            </div>

            <div class="input_container">
                <p class="input_title">Новый пароль</p>
                <input type="password" name="password" required class="input">
            </div>

            <div class="input_container">
                <p class="input_title">Подтвердите новый пароль</p>
                <input type="password" name="password_confirmation" required class="input">
            </div>

            <button type="submit" class="btn_register">Обновить пароль</button>
        </form>

        <hr style="margin: 30px 0;">

        <!-- 3. Кнопка выхода из аккаунта -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn_register" style="background-color: #d9534f;">Выйти из аккаунта</button>
        </form>
    </div>
@endsection
