@extends('layouts.main')

@section('title', 'Мои заказы')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/registration.css') }}">
@endpush

@section('content')
<div style="max-width: 800px; margin: 20px auto;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1>Мои заказы</h1>
        <a href="{{ route('catalog.index') }}" style="text-decoration: none; color: #333;">← В каталог</a>
    </div>

    @if($orders->isEmpty())
        <div style="padding: 20px; border: 1px solid #ccc; text-align: center;">
            <p>У вас пока нет оформленных заказов.</p>
        </div>
    @else
        <div style="display: flex; flex-direction: column; gap: 15px;">
            @foreach($orders as $order)
                <div style="border: 1px solid #ccc; padding: 15px;">
                    <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 10px;">
                        <div>
                            <strong>Заказ №{{ $order->id }}</strong>
                            <span style="font-size: 13px; color: #666; margin-left: 10px;">от {{ $order->created_at }}</span>
                        </div>
                        <div>
                            Статус: <strong style="padding: 3px 8px; border: 1px solid #333;">{{ $order->status }}</strong>
                        </div>
                    </div>

                    <p style="margin: 0 0 5px 0; font-size: 14px;"><strong>Адрес доставки:</strong> {{ $order->delivery_address }}</p>
                    <p style="margin: 0 0 10px 0; font-size: 14px;"><strong>Время доставки:</strong> {{ $order->delivery_time }}</p>

                    <div style="background: #fafafa; padding: 10px; border: 1px solid #eee; margin-bottom: 10px;">
                        <p style="margin: 0 0 5px 0; font-size: 13px; font-weight: bold;">Состав заказа:</p>
                        <ul style="margin: 0; padding-left: 20px; font-size: 14px;">
                            @foreach($order->items as $item)
                                <li>
                                    {{ $item->product ? $item->product->product_name : 'Товар удалён' }} —
                                    {{ $item->quanity }} шт. × {{ $item->price }} руб.
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <p style="margin: 0; font-weight: bold; text-align: right;">
                        Сумма заказа: {{ $order->total_price }} руб.
                    </p>
                </div>
            @endforeach
        </div>
    @endif
</div>

@endsection
