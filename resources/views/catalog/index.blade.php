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
                <div style="border: 1px solid #ccc; padding: 15px;">
                    @if($product->image_url)
                        <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->product_name }}" style="width: 100%; height: 180px; object-fit: cover; margin-bottom: 10px;">
                    @else
                        <div style="width: 100%; height: 180px; border: 1px dashed #ccc; display: flex; align-items: center; justify-content: center; margin-bottom: 10px; color: #888;">
                            Нет фото
                        </div>
                    @endif

                    <h3 style="margin: 0 0 5px 0;">{{ $product->product_name }}</h3>
                    <p style="margin: 0 0 5px 0; font-size: 14px; color: #555;">Категория: {{ $product->category->name }}</p>

                    @if($product->weight)
                        <p style="margin: 0 0 5px 0; font-size: 14px;">Вес: {{ $product->weight }} г</p>
                    @endif

                    <p style="margin: 0 0 10px 0; font-size: 14px;">{{ $product->description }}</p>

                    <p style="font-weight: bold; margin: 0 0 5px 0;">Цена: {{ $product->price }} руб.</p>

                    <p style="margin: 0; font-size: 13px; color: {{ $product->in_stock ? 'green' : 'red' }};">
                        {{ $product->in_stock ? 'В наличии' : 'Нет в наличии' }}
                    </p>

                    @auth
                        @if($product->in_stock)
                            <form action="{{ route('cart.add', $product) }}" method="POST" style="margin-top: 10px;">
                                @csrf
                                <button type="submit" style="padding: 6px 12px; border: 1px solid #333; background: #f9f9f9; cursor: pointer; width: 100%;">
                                    В корзину
                                </button>
                            </form>
                        @endif
                    @endauth

                        @auth
                            @if(in_array(auth()->user()->role, ['admin', 'manager']))
                                <div style="margin-top: 12px; padding-top: 10px; border-top: 1px solid #eee; display: flex; gap: 10px; align-items: center;">
                                    <a href="{{ route('catalog.edit', $product) }}" style="padding: 4px 10px; border: 1px solid #333; text-decoration: none; color: #000; font-size: 13px;">
                                        Изменить
                                    </a>

                                    <form action="{{ route('catalog.destroy', $product) }}" method="POST" onsubmit="return confirm('Удалить этот товар?');" style="margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="padding: 4px 10px; border: 1px solid red; background: none; color: red; cursor: pointer; font-size: 13px;">
                                            Удалить
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                </div>
            @empty
                <p>Товары не найдены.</p>
            @endforelse
        </div>
    </div>
@endsection
