@extends('layouts.main')

@section('title', 'Админ-панель')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/tables.css') }}">
@endpush

@section('content')
<h1 class="admin_title">УПРАВЛЕНИЕ ЗАКАЗАМИ</h1>
<div class="page-container">

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-wrapper">
        <table class="custom-table">
            <thead>
            <tr>
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
                        <span class="sub-text">{{ $order->user->email ?? '' }}</span>
                    </td>
                    <td>
                        <ul class="order-items-list">
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
                        <span class="sub-text">К: {{ $order->delivery_time }}</span>
                    </td>
                    <td class="price-cell"><strong>{{ $order->total_price }} руб.</strong></td>
                    <td>
                        <form action="{{ route('orders.updateStatus', $order) }}" method="POST" class="status-form">
                            @csrf
                            @method('PATCH')

                            <select name="status" class="status-select">
                                @foreach(['Новый', 'Готовится', 'В доставке', 'Выполнен', 'Отменён'] as $statusOption)
                                    <option value="{{ $statusOption }}" {{ $order->status === $statusOption ? 'selected' : '' }}>
                                        {{ $statusOption }}
                                    </option>
                                @endforeach
                            </select>

                            <button type="submit" class="status-btn">ОК</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="empty-message">Заказов пока нет.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
