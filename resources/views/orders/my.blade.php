@extends('layouts.main')

@section('title', 'Мои заказы')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/my_orders.css') }}">
@endpush

@section('content')
<div class="myorders_container">
    <div class="myorders_bar">
        <h1>Мои заказы</h1>
        <a href="{{ route('catalog.index') }}" class="back_to_catalog">← В каталог</a>
    </div>

    @if($orders->isEmpty())
        <div class="empty_message">
            <p>У вас пока нет оформленных заказов.</p>
        </div>
    @else
        <div class="myorders_items">
            @foreach($orders as $order)
                <div class="myorders_item">
                    <div class="my_orders_item_bar">
                        <div>
                            <strong>Заказ №{{ $order->id }}</strong>
                            <span class="myorders_date">от {{ $order->created_at }}</span>
                        </div>
                        <div>
                            Статус: <strong class="status_message">{{ $order->status }}</strong>
                        </div>
                    </div>

                    <p class="delivery_details"><strong>Адрес доставки:</strong> {{ $order->delivery_address }}</p>
                    <p class="delivery_details"><strong>Время доставки:</strong> {{ $order->delivery_time }}</p>

                    <div class="components_orders">
                        <p class="components_orders_title">Состав заказа:</p>
                        <ul class="components_list">
                            @foreach($order->items as $item)
                                <li>
                                    @if($item->product)
                                        {{ $item->product->product_name }} — {{ $item->quanity }} шт. × {{ $item->price }} руб.
                                    @elseif($item->customCake)
                                        Торт на заказ ({{ $item->customCake->biscuit_type }}, {{ $item->customCake->cream_type }}) — {{ $item->quanity }} шт. × {{ $item->price }} руб.
                                    @else
                                        Товар удалён — {{ $item->quanity }} шт. × {{ $item->price }} руб.
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <p class="total_price_order">
                        Сумма заказа: {{ $order->total_price }} руб.
                    </p>
                </div>
            @endforeach
        </div>
    @endif
</div>

@endsection
