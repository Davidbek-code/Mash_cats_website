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
    <section style="max-width: 1000px; margin: 40px auto;">
        <div class="container">
            <h1 class="welcome_subtitle">НОВИНКИ</h1>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
            </div>

            @if($newProducts->isEmpty())
                <p>Новинок пока нет.</p>
            @else
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px;">
                    @foreach($newProducts as $product)
                        @include('partials.product_card', ['product' => $product])
                    @endforeach
                </div>
           @endif
        </div>
    </section>
@endsection
