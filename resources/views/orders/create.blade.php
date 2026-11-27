@extends('layouts.main')

@section('title', 'Оформление заказа')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/create_order.css') }}">
@endpush

@section('content')

<h1>ОФОРМЛЕНИЕ ДОСТАВКИ</h1>

<div class="order_container">
    <div class="back_to_cart">
        <a href="{{ route('cart.index') }}" style="text-decoration: none; color: #333;">← Назад в корзину</a>
    </div>

    <div class="compount_order">
        <h4>Состав заказа:</h4>
        <ul class="compount_list">
            @foreach($cartItems as $item)
                <li style="margin-bottom: 5px;">
                    @if($item->product)
                        {{ $item->product->product_name }} —
                        <strong>{{ $item->quanity }} шт.</strong> ×
                        {{ $item->product->price }} руб. =
                        <strong>{{ $item->product->price * $item->quanity }} руб.</strong>
                    @elseif($item->customCake)
                        Торт на заказ ({{ $item->customCake->biscuit_type }}, {{ $item->customCake->cream_type }}, {{ $item->customCake->filling_type }}) —
                        <strong>{{ $item->quanity }} шт.</strong> ×
                        {{ $item->customCake->total_price }} руб. =
                        <strong>{{ $item->customCake->total_price * $item->quanity }} руб.</strong>
                    @endif
                </li>
            @endforeach
        </ul>
        <p class="total_price">
            Итого к оплате при получении: {{ $totalPrice }} руб.
        </p>
    </div>

    @if ($errors->any())
        <div class='errors'>
            <ul style="margin: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf

        <div style="margin-bottom: 15px;">
            <label>Адрес доставки (улица, дом, квартира):</label><br>
            <input type="text" name="delivery_address" value="{{ old('delivery_address') }}" required placeholder="ул. Ленина, д. 10, кв. 25" class="address_input">
        </div>

        <div style="margin-bottom: 20px;">
            <label>Желаемые дата и время доставки:</label><br>
            <input type="datetime-local" name="delivery_time" value="{{ old('delivery_time') }}" required class="address_input">
        </div>

        <button type="submit" class="confirm_btn">
            Подтвердить заказ
        </button>
    </form>
</div>

@endsection
