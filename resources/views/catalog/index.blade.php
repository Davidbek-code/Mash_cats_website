@extends('layouts.main')

@section('title', 'Каталог')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/catalog.css') }}">
@endpush

@section('content')
    <div class="catalog">
        <div class="catalog_title_box">
            <h1>КАТАЛОГ</h1>
            @auth
                @if(in_array(auth()->user()->role, ['admin', 'manager']))
                    <a href="{{ route('catalog.create') }}" class='add_product'>
                        Добавить товар
                    </a>
                @endif
            @endauth
        </div>

        @if(session('success'))
            <div class="success_message">
                {{ session('success') }}
            </div>
        @endif

        <form method="GET" action="{{ route('catalog.index') }}" class="product_menu_bar">

            <input type="text" name="search" value="{{ request('search') }}" placeholder="Поиск" class="menu_input">

            <select name="category" class="menu_input">
                <option value="">Все категории</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <select name="sort" class="menu_input">
                <option value="">Без сортировки</option>
                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Сначала дешевые</option>
                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Сначала дорогие</option>
                <option value="weight_asc" {{ request('sort') == 'weight_asc' ? 'selected' : '' }}>Сначала легкие (по весу)</option>
                <option value="weight_desc" {{ request('sort') == 'weight_desc' ? 'selected' : '' }}>Сначала тяжелые (по весу)</option>
            </select>

            <label class="in_stock_check">
                <input type="checkbox" name="in_stock" value="1" {{ request('has') || request('in_stock') ? 'checked' : '' }}>
                В наличии
            </label>

            <button type="submit" class="search_button" >Найти</button>
            <a href="{{ route('catalog.index') }}" class="reset_button" >Сбросить</a>
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
