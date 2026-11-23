@extends('layouts.main')

@section('title', 'Каталог')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/catalog.css') }}">
@endpush

@section('content')
    <div style="max-width: 1000px; margin: 20px auto;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h1>Каталог товаров</h1>
            @auth
                @if(in_array(auth()->user()->role, ['admin', 'manager']))
                    <a href="{{ route('catalog.create') }}" style="padding: 8px 15px; border: 1px solid #333; text-decoration: none; color: #000;">
                        Добавить товар
                    </a>
                @endif
            @endauth
        </div>

        @if(session('success'))
            <div style="padding: 10px; border: 1px solid green; color: green; margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif

        <form method="GET" action="{{ route('catalog.index') }}" style="margin-bottom: 20px; padding: 15px; border: 1px solid #ccc; display: flex; flex-wrap: wrap; gap: 10px; align-items: center;">

            <!-- Поиск -->
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Поиск по названию..." style="padding: 5px;">

            <!-- Фильтр по категории -->
            <select name="category" style="padding: 5px;">
                <option value="">Все категории</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <!-- Сортировка -->
            <select name="sort" style="padding: 5px;">
                <option value="">Без сортировки</option>
                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Сначала дешевые</option>
                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Сначала дорогие</option>
                <option value="weight_asc" {{ request('sort') == 'weight_asc' ? 'selected' : '' }}>Сначала легкие (по весу)</option>
                <option value="weight_desc" {{ request('sort') == 'weight_desc' ? 'selected' : '' }}>Сначала тяжелые (по весу)</option>
            </select>

            <!-- Фильтр по наличию -->
            <label style="font-size: 14px; cursor: pointer;">
                <input type="checkbox" name="in_stock" value="1" {{ request('has') || request('in_stock') ? 'checked' : '' }}>
                Только в наличии
            </label>

            <!-- Кнопки управления -->
            <button type="submit" style="padding: 5px 15px; cursor: pointer;">Найти</button>
            <a href="{{ route('catalog.index') }}" style="padding: 5px 10px; border: 1px solid #999; text-decoration: none; color: #333; font-size: 14px;">Сбросить</a>
        </form>

        <!-- Сетка товаров с простыми рамками -->
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px;">
            @forelse($products as $product)
                @include('partials.product_card', ['product' => $product])
            @empty
                <p>Товары не найдены.</p>
            @endforelse
        </div>
    </div>
@endsection
