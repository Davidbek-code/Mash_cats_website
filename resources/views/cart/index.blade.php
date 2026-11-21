@extends('layouts.main')

@section('title', 'Корзина')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/catalog.css') }}">
@endpush

@section('content')

<div style="max-width: 800px; margin: 20px auto;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1>Ваша корзина</h1>
        <a href="{{ route('catalog.index') }}" style="text-decoration: none; color: #333;">← Вернуться в каталог</a>
    </div>

    @if(session('success'))
        <div style="padding: 10px; border: 1px solid green; color: green; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    @if($cartItems->isEmpty())
        <div style="padding: 20px; border: 1px solid #ccc; text-align: center;">
            <p>В корзине пока пусто.</p>
        </div>
    @else
        <div style="display: flex; flex-direction: column; gap: 10px;">
            @foreach($cartItems as $item)
                <div style="border: 1px solid #ccc; padding: 15px; display: flex; justify-content: space-between; align-items: center;">

                    <!-- Информация о товаре -->
                    <div>
                        @if($item->product)
                            <h3 style="margin: 0 0 5px 0;">{{ $item->product->product_name }}</h3>
                            <p style="margin: 0; font-size: 14px; color: #555;">
                                Цена: {{ $item->product->price }} руб. | Вес: {{ $item->product->weight ?? '-' }} г
                            </p>
                        @elseif($item->custom_cake_id)
                            <h3 style="margin: 0 0 5px 0;">Торт на заказ #{{ $item->custom_cake_id }}</h3>
                        @endif
                    </div>

                    <!-- Управление количеством и удаление -->
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <form action="{{ route('cart.update', $item) }}" method="POST" style="display: flex; align-items: center; gap: 5px; margin: 0;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" name="action" value="decrease" style="padding: 2px 8px; cursor: pointer;">-</button>
                            <span style="min-width: 20px; text-align: center;">{{ $item->quanity }}</span>
                            <button type="submit" name="action" value="increase" style="padding: 2px 8px; cursor: pointer;">+</button>
                        </form>

                        <div style="font-weight: bold; min-width: 90px; text-align: right;">
                            {{ $item->product ? $item->product->price * $item->quanity : 0 }} руб.
                        </div>

                        <form action="{{ route('cart.destroy', $item) }}" method="POST" style="margin: 0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="padding: 4px 8px; border: 1px solid red; background: none; color: red; cursor: pointer;">
                                Удалить
                            </button>
                        </form>
                    </div>

                </div>
            @endforeach
        </div>

        <!-- Итого и переход к оформлению -->
        <div style="margin-top: 20px; padding: 15px; border: 1px solid #333; display: flex; justify-content: space-between; align-items: center;">
            <h3 style="margin: 0;">Итого: {{ $totalPrice }} руб.</h3>

            <a href="{{ route('orders.create') }}" style="padding: 10px 20px; border: 1px solid #000; background: #eee; text-decoration: none; color: #000; font-weight: bold;">
                Оформить заказ →
            </a>
        </div>
    @endif
</div>


@endsection

