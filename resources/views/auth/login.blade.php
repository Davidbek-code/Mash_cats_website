{{--<!DOCTYPE html>--}}
{{--<html lang="ru">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <title>Зефирные котята</title>--}}
{{--    <link rel="stylesheet" href="{{ asset('css/registration.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('css/header.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">--}}
{{--</head>--}}
{{--<body>--}}
{{--<header class="header">--}}
{{--    <div class="container">--}}
{{--        <nav class="header_nav">--}}
{{--            <input type="checkbox" id="menu-toggle" class="menu-toggle">--}}

{{--            <label for="menu-toggle" class="burger-btn">--}}
{{--                <span></span>--}}
{{--                <span></span>--}}
{{--                <span></span>--}}
{{--            </label>--}}
{{--            <ul class="header_list">--}}
{{--                <li><a href="./index.html"><img alt="logo" class="logo_img" src="{{ asset('img/cat_logo.svg') }}"></a></li>--}}
{{--                <li><a href="./about.html">О нас</a></li>--}}
{{--                <li><a href="./catalog.html">Меню</a></li>--}}
{{--                <li><a href="./services.html">Услуги</a></li>--}}
{{--                <li><a href="./reviews.html">Отзывы</a></li>--}}
{{--                <li>--}}
{{--                    <ul class="header_icon_list">--}}
{{--                        <li>--}}
{{--                            <a href="./favorites.html"><img class="icon_img" alt="favorites" src="{{ asset('img/icon_fav.svg') }}"></a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="./registration.html"><img class="icon_img" alt="registartion" src="{{ asset('img/icon_user.svg') }}"></a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="./cart.html"><img class="icon_img" alt="cart" src="{{ asset('img/icon_cart.svg') }}"></a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </nav>--}}
{{--    </div>--}}
{{--</header>--}}
{{--<main>--}}
{{--    <h2 class="registration_title">ВХОД</h2>--}}
@extends('layouts.main')

@section('title', 'Вход в аккаунт')

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
@endsection
{{--</main>--}}
{{--<footer class="footer">--}}
{{--    <div class="container">--}}
{{--        <nav class="footer_nav">--}}
{{--            <h2 class="footer_marsh_title">ЗЕФИРНЫЕ</h2>--}}
{{--            <h2 class="footer_cats_title">КОТЯТА</h2>--}}
{{--            <ul class="footer_nav_string1">--}}
{{--                <li><a href="./about.html">О нас</a></li>--}}
{{--                <li><a href="./favorites.html">Избранное</a></li>--}}
{{--                <li><a href="./reviews.html">Отзывы</a></li>--}}
{{--            </ul>--}}
{{--            <ul class="footer_nav_string2">--}}
{{--                <li><a href="./catalog.html">Меню</a></li>--}}
{{--                <li><a href="./registration.html">Профиль</a></li>--}}
{{--                <li><a href="./services.html">Услуги</a></li>--}}
{{--            </ul>--}}
{{--        </nav>--}}
{{--        <div class="footer_contacts">--}}
{{--            <h4 class="footer_subtitle">Контакты</h4>--}}
{{--            <div class="footer_phone">--}}
{{--                <img alt="phone_logo" src="{{ asset('img/phone_logo.svg') }}">--}}
{{--                <a href="tel:+88005553535">+8(800)555 35 35</a>--}}
{{--            </div>--}}
{{--            <div class="footer_mail">--}}
{{--                <img alt="mail_logo" src="{{ asset('img/mail_logo.svg') }}">--}}
{{--                <a href="mailto:mashcats@mail.ru">mashcats@mail.ru</a>--}}
{{--            </div>--}}
{{--            <div class="footer_adress">--}}
{{--                <img alt="adress_logo" src="{{ asset('img/adress_logo.svg') }}">--}}
{{--                <a href="https://go.2gis.com/mDOea">г.Томск, ул. Войкова, д.49</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="footer_socialmedia">--}}
{{--            <h4 class="footer_subtitle">Соцсети</h4>--}}
{{--            <div class="footer_socialmedia_box">--}}
{{--                <a href="https://max.ru/"><img alt="Max" src="{{ asset('img/social_media_icon1.png_fav.svg') }}"></a>--}}
{{--                <a href="https://m.vk.com/"><img alt="VK" src="{{ asset('img/social_media_icon2.svg') }}"></a>--}}
{{--                <a href="https://dzen.ru/"><img alt="Dzen" src="{{ asset('img/social_media_icon3.svg') }}"></a>--}}
{{--                <a href="https://ok.ru/"><img alt="OK" src="{{ asset('img/social_media_icon4.svg') }}"></a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</footer>--}}
{{--</body>--}}
{{--</html>--}}
