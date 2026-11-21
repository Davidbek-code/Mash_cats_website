@extends('layouts.main')

@section('title', 'Корзина')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/registration.css') }}">
@endpush

@section('content')

<h1 class="admin_title">ОФОРМЛЕНИЕ ДОСТАВКИ</h1>

<div style="max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #ccc;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
        <a href="{{ route('cart.index') }}" style="text-decoration: none; color: #333;">← Назад в корзину</a>
    </div>

    <!-- Краткий состав заказа -->
    <div style="border: 1px solid #eee; padding: 10px; margin-bottom: 20px; background: #fafafa;">
        <h4 style="margin: 0 0 10px 0;">Состав заказа:</h4>
        <ul style="margin: 0; padding-left: 20px;">
            @foreach($cartItems as $item)
                <li style="margin-bottom: 5px;">
                    {{ $item->product->product_name }} —
                    <strong>{{ $item->quanity }} шт.</strong> ×
                    {{ $item->product->price }} руб. =
                    <strong>{{ $item->product->price * $item->quanity }} руб.</strong>
                </li>
            @endforeach
        </ul>
        <p style="margin: 10px 0 0 0; font-weight: bold; font-size: 16px;">
            Итого к оплате при получении: {{ $totalPrice }} руб.
        </p>
    </div>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px;">
            <ul style="margin: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Форма ввода адреса и времени доставки -->
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf

        <div style="margin-bottom: 15px;">
            <label>Адрес доставки (улица, дом, квартира):</label><br>
            <input type="text" name="delivery_address" value="{{ old('delivery_address') }}" required placeholder="Например: ул. Ленина, д. 10, кв. 25" style="width: 100%; padding: 8px; margin-top: 5px;">
        </div>

        <div style="margin-bottom: 20px;">
            <label>Желаемые дата и время доставки:</label><br>
            <input type="datetime-local" name="delivery_time" value="{{ old('delivery_time') }}" required style="width: 100%; padding: 8px; margin-top: 5px;">
        </div>

        <button type="submit" style="width: 100%; padding: 10px; border: 1px solid #000; background: #eee; font-weight: bold; cursor: pointer;">
            Подтвердить заказ
        </button>
    </form>
</div>

@endsection
