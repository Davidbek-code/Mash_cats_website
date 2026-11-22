@extends('layouts.main')

@section('title', 'Админ-панель')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/registration.css') }}">
@endpush

@section('content')
    <div style="max-width: 1100px; margin: 20px auto;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h1>Управление заказами</h1>
            <a href="{{ route('catalog.index') }}" style="text-decoration: none; color: #333;">← В каталог</a>
        </div>

        @if(session('success'))
            <div style="padding: 10px; border: 1px solid green; color: green; margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif

        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
            <thead>
            <tr style="background: #f4f4f4;">
                <th>№</th>
                <th>Клиент</th>
                <th>Состав заказа</th>
                <th>Адрес и время доставки</th>
                <th>Сумма</th>
                <th>Статус</th>
            </tr>
            </thead>
            <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>
                        <strong>{{ $order->user->name ?? 'Неизвестно' }}</strong><br>
                        <span style="color: #555; font-size: 12px;">{{ $order->user->email ?? '' }}</span>
                    </td>
                    <td>
                        <ul style="margin: 0; padding-left: 15px;">
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
                    </td>
                    <td>
                        {{ $order->delivery_address }}<br>
                        <span style="color: #555; font-size: 12px;">К: {{ $order->delivery_time }}</span>
                    </td>
                    <td><strong>{{ $order->total_price }} руб.</strong></td>
                    <td>
                        <form action="{{ route('orders.updateStatus', $order) }}" method="POST" style="display: flex; gap: 5px; margin: 0;">
                            @csrf
                            @method('PATCH')

                            <select name="status" style="padding: 4px;">
                                @foreach(['Новый', 'Готовится', 'В доставке', 'Выполнен', 'Отменён'] as $statusOption)
                                    <option value="{{ $statusOption }}" {{ $order->status === $statusOption ? 'selected' : '' }}>
                                        {{ $statusOption }}
                                    </option>
                                @endforeach
                            </select>

                            <button type="submit" style="padding: 4px 8px; cursor: pointer;">ОК</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Заказов пока нет.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

@endsection
