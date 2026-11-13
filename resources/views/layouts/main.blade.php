<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Зефирные котята')</title>
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

    @stack('styles')
</head>
<body>


<header class="header">
    <div class="container">
        <nav class="header_nav">
            <input type="checkbox" id="menu-toggle" class="menu-toggle">

            <label for="menu-toggle" class="burger-btn">
                <span></span>
                <span></span>
                <span></span>
            </label>
            <ul class="header_list">
                <li><a href="{{ route('home') }}">
                        <img src="{{ asset('img/cat_logo.svg') }}" alt="Логотип">
                    </a></li>
                @auth
                    @if (Auth::user()->role === 'user')
                        <li><a href="{{ route('about') }}">О нас</a></li>
                    @endif
                @endauth

                <li><a href="{{ route('catalog') }}">Меню</a></li>
                <li><a href="{{ route('services') }}">Услуги</a></li>
                <li><a href="{{ route('reviews') }}">Отзывы</a></li>
                @auth
                    @if (Auth::user()->role === 'admin')
                        <li><a href="{{ route('admin.users.index') }}">Админ-панель</a></li>
                    @endif
                @endauth
                <li>
                    <ul class="header_icon_list">
                        <li>
                            <a href="{{ route('home') }}"><img class="icon_img" alt="favorites" src="{{ asset('img/icon_fav.svg') }}"></a>
                        </li>
                        <li>
                            @auth
                                <a href="{{ route('profile.edit') }}" title="Личный кабинет">
                                    <img class="icon_img" alt="profile" src="{{ asset('img/icon_user.svg') }}">
                                </a>
                            @else
                                <a href="{{ route('login') }}" title="Войти">
                                    <img class="icon_img" alt="login" src="{{ asset('img/icon_user.svg') }}">
                                </a>
                            @endauth
                        </li>
                        <li>
                            <a href="{{ route('cart') }}"><img class="icon_img" alt="cart" src="{{ asset('img/icon_cart.svg') }}"></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</header>

<main>
    @yield('content')
</main>

<footer class="footer">
    <div class="container">
        <nav class="footer_nav">
            <h2 class="footer_marsh_title">ЗЕФИРНЫЕ</h2>
            <h2 class="footer_cats_title">КОТЯТА</h2>
            <ul class="footer_nav_string1">
                <li><a href="{{ route('about') }}">О нас</a></li>
                <li><a href="{{ route('home') }}">Избранное</a></li>
                <li><a href="{{ route('reviews') }}">Отзывы</a></li>
            </ul>
            <ul class="footer_nav_string2">
                <li><a href="{{ route('catalog') }}">Меню</a></li>
                <li><a href="{{ route('home') }}">Профиль</a></li>
                <li><a href="{{ route('services') }}">Услуги</a></li>
            </ul>
        </nav>
        <div class="footer_contacts">
            <h4 class="footer_subtitle">Контакты</h4>
            <div class="footer_phone">
                <img alt="phone_logo" src="{{ asset('img/phone_logo.svg') }}">
                <a href="tel:+88005553535">+8(800)555 35 35</a>
            </div>
            <div class="footer_mail">
                <img alt="mail_logo" src="{{ asset('img/mail_logo.svg') }}">
                <a href="mailto:mashcats@mail.ru">mashcats@mail.ru</a>
            </div>
            <div class="footer_adress">
                <img alt="adress_logo" src="{{ asset('img/adress_logo.svg') }}">
                <a href="https://go.2gis.com/mDOea">г.Томск, ул. Войкова, д.49</a>
            </div>
        </div>
        <div class="footer_socialmedia">
            <h4 class="footer_subtitle">Соцсети</h4>
            <div class="footer_socialmedia_box">
                <a href="https://max.ru/"><img alt="Max" src="{{ asset('img/social_media_icon1.png') }}"></a>
                <a href="https://m.vk.com/"><img alt="VK" src="{{ asset('img/social_media_icon2.png') }}"></a>
                <a href="https://dzen.ru/"><img alt="Dzen" src="{{ asset('img/social_media_icon3.png') }}"></a>
                <a href="https://ok.ru/"><img alt="OK" src="{{ asset('img/social_media_icon4.png') }}"></a>
            </div>
        </div>
    </div>
</footer>

</body>
</html>
