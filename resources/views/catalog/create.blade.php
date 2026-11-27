@extends('layouts.main')

@section('title', 'Создание товара')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/create_edit_product.css') }}">
@endpush

@section('content')
<h1>ДОБАВИТЬ ТОВАР</h1>
<div class="form_item">
    <a href="{{ route('catalog.index') }}">← Назад в каталог</a>

    @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('catalog.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div style="margin-bottom: 10px;">
            <label>Категория:</label><br>
            <select name="category_id" required class="category_form">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 10px;">
            <label>Название товара:</label><br>
            <input type="text" name="product_name" required class="name_form">
        </div>

        <div style="margin-bottom: 10px;">
            <label>Описание:</label><br>
            <textarea name="description" rows="3" class="description_form"></textarea>
        </div>

        <div style="margin-bottom: 10px;">
            <label>Цена:</label><br>
            <input type="number" step="0.01" name="price" required class="price_form">
        </div>

        <div style="margin-bottom: 10px;">
            <label>Вес:</label><br>
            <input type="number" name="weight" class="weight_form">
        </div>

        <div style="margin-bottom: 10px;">
            <label>Фото товара:</label><br>
            <input type="file" name="image" accept="image/*">
        </div>

        <div style="margin-bottom: 15px;">
            <label>
                <input type="checkbox" name="in_stock" value="1" checked> В наличии
            </label>
        </div>

        <button type="submit" class="btn_save_edit">Сохранить товар</button>
    </form>
</div>

@endsection
