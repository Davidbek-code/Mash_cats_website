@extends('layouts.main')

@section('title', 'Корзина')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endpush

@section('content')

<div class="cart_container">
    <div class="cart_items_container">
        <h1>КОРЗИНА</h1>
        <a href="{{ route('catalog.index') }}" class="back_to_catalog">← Вернуться в каталог</a>
    </div>

    @if(session('success'))
        <div class="success_message">
            {{ session('success') }}
        </div>
    @endif

    @if($cartItems->isEmpty())
        <div class="empty_message">
            <p>В корзине пока пусто.</p>
        </div>
    @else
        <div class="cart_items">
            @foreach($cartItems as $item)
                <div class="cart_item">


                    <div>
                        @if($item->product)
                            <h3>{{ $item->product->product_name }}</h3>
                            <p class="cart_item_description">
                                Цена: {{ $item->product->price }} руб. | Вес: {{ $item->product->weight ?? '-' }} г
                            </p>
                        @elseif($item->customCake)
                            <h3>Торт на заказ</h3>
                            <p class="cart_custom_description">
                                Бисквит: {{ $item->customCake->biscuit_type }},<br>
                                Крем: {{ $item->customCake->cream_type }}, <br>
                                Начинка: {{ $item->customCake->filling_type }}
                                @if($item->customCake->decor_text)
                                    <br>Надпись: «{{ $item->customCake->decor_text }}»
                                @endif
                            </p>
                        @endif
                    </div>

                    <div class="cart_patch">
                        <form action="{{ route('cart.update', $item) }}" method="POST" class="cart_patch_form">
                            @csrf
                            @method('PATCH')
                            <button type="submit" name="action" value="decrease" class="patch_btn">-</button>
                            <span style="min-width: 20px; text-align: center;">{{ $item->quanity }}</span>
                            <button type="submit" name="action" value="increase" class="patch_btn">+</button>
                        </form>

                        <div class="cart_item_price">
                            @if($item->product)
                                {{ $item->product->price * $item->quanity }} руб.
                            @elseif($item->customCake)
                                {{ $item->customCake->total_price * $item->quanity }} руб.
                            @endif
                        </div>

                        <form action="{{ route('cart.destroy', $item) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="cart_item_delete_btn">
                                Удалить
                            </button>
                        </form>
                    </div>

                </div>
            @endforeach
        </div>

        <div class="create_order_container">
            <h3>Итого: {{ $totalPrice }} руб.</h3>

            <a href="{{ route('orders.create') }}" class="create_order_btn">
                Оформить заказ
            </a>
        </div>
    @endif
</div>


@endsection

