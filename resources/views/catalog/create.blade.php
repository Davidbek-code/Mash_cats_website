@extends('layouts.main')

@section('title', 'Создание товара')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/catalog.css') }}">
@endpush

@section('content')

<div style="max-width: 500px; margin: 20px auto; padding: 20px; border: 1px solid #ccc;">
    <h2>Добавить новый товар</h2>
    <a href="{{ route('catalog.index') }}">← Назад в каталог</a>

    <!-- Вывод ошибок валидации, если что-то заполнили неверно -->
    @if ($errors->any())
        <div style="color: red; margin-top: 10px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('catalog.store') }}" method="POST" enctype="multipart/form-data" style="margin-top: 15px;">
        @csrf

        <div style="margin-bottom: 10px;">
            <label>Категория:</label><br>
            <select name="category_id" required style="width: 100%; padding: 5px;">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 10px;">
            <label>Название товара:</label><br>
            <input type="text" name="product_name" required style="width: 100%; padding: 5px;">
        </div>

        <div style="margin-bottom: 10px;">
            <label>Описание:</label><br>
            <textarea name="description" rows="3" style="width: 100%; padding: 5px;"></textarea>
        </div>

        <div style="margin-bottom: 10px;">
            <label>Цена (руб.):</label><br>
            <input type="number" step="0.01" name="price" required style="width: 100%; padding: 5px;">
        </div>

        <div style="margin-bottom: 10px;">
            <label>Вес (в граммах):</label><br>
            <input type="number" name="weight" placeholder="Например: 500" style="width: 100%; padding: 5px;">
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

        <button type="submit" style="padding: 8px 15px; cursor: pointer;">Сохранить товар</button>
    </form>
</div>

@endsection
