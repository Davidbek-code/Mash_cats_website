@extends('layouts.main')

@section('title', 'Зефирные котята')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endpush

@section('content')
    <section class="welcome">
        <div class="container">
            <div class="welcome_textbox">
                <h1 class="welcome_title">ДОБРО<br>ПОЖАЛОВАТЬ<br></h1>
                <h2 class="welcome_subtitle">в нашу кондитерскую</h2>
                <h1 class="welcome_marsh_title">ЗЕФИРНЫЕ</h1>
                <h1 class="welcome_cat_title">КОТЯТА</h1>

                <a href="{{ route('catalog.index') }}" class="btn_buy">Сделать заказ</a>
            </div>
        </div>
    </section>
    <section class="services">
        <div class="container">
            <h1 class="services_title">Для кого мы печём</h1>
            <div class="service_items">
                <div class="services_item">
                    <p class="services_item_title">На любой праздник</p>
                    <img class="services_item_img" alt="" src="{{ asset('img/service_item_1.png') }}">
                    <p class="services_item_subtitle">Хотите удивить гостей и вкусно поесть?</p>
                    <p>Наша команда сделает всё, чтобы Ваш праздник удался</p>
                </div>
                <div class="services_item">
                    <p class="services_item_title">На свадьбу</p>
                    <img class="services_item_img" alt="" src="{{ asset('img/service_item_2.png') }}">
                    <p class="services_item_subtitle">Хотите удивить гостей и вкусно поесть?</p>
                    <p>Наша команда сделает всё, чтобы Ваш праздник удался</p>
                </div>
                <div class="services_item">
                    <p class="services_item_title">На каждый день</p>
                    <img class="services_item_img" alt="" src="{{ asset('img/service_item_3.png') }}">
                    <p class="services_item_subtitle">Хотите удивить гостей и вкусно поесть?</p>
                    <p>Наша команда сделает всё, чтобы Ваш праздник удался</p>
                </div>
            </div>
        </div>
    </section>
    <section class="new_products">
        <div class="container">
            <h1 class="new_products_title">НОВИНКИ</h1>
            <div class="new_products_items">
                <div class="new_products_item">
                    <img alt="" src="{{ asset('img/new_products_1.png') }}">
                    <h4 class="new_products_item_title">Дикий огурец</h4>
                    <p>Это уникальное растение, известное своим необычным плодом. Особые моменты ухода включают в себя управление его сильным ростом</p>
                    <div class="order_box">
                        <h4>500 руб</h4>
                        <a href="/" class="new_products_btn_buy">ЗАКАЗАТЬ</a>
                    </div>
                </div>
                <div class="new_products_item">
                    <img alt="" src="{{ asset('img/new_products_1.png') }}">
                    <h4 class="new_products_item_title">Дикий огурец</h4>
                    <p>Это уникальное растение, известное своим необычным плодом. Особые моменты ухода включают в себя управление его сильным ростом</p>
                    <div class="order_box">
                        <h4>500 руб</h4>
                        <a href="/" class="new_products_btn_buy">ЗАКАЗАТЬ</a>
                    </div>
                </div>
                <div class="new_products_item">
                    <img alt="" src="{{ asset('img/new_products_1.png') }}">
                    <h4 class="new_products_item_title">Дикий огурец</h4>
                    <p>Это уникальное растение, известное своим необычным плодом. Особые моменты ухода включают в себя управление его сильным ростом</p>
                    <div class="order_box">
                        <h4>500 руб</h4>
                        <a href="/" class="new_products_btn_buy">ЗАКАЗАТЬ</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
