@extends('layouts.main')

@section('title', 'Изменение товара')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/create_edit_product.css') }}">
@endpush

@section('content')
    <h1>ИЗМЕНИТЬ ТОВАР</h1>
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

        <form action="{{ route('catalog.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 10px;">
                <label>Категория:</label><br>
                <select name="category_id" required class="category_form">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 10px;">
                <label>Название товара:</label><br>
                <input type="text" name="product_name" value="{{ old('product_name', $product->product_name) }}" required class="name_form">
            </div>

            <div style="margin-bottom: 10px;">
                <label>Описание:</label><br>
                <textarea name="description" rows="3" class="description_form">{{ old('description', $product->description) }}</textarea>
            </div>

            <div style="margin-bottom: 10px;">
                <label>Цена:</label><br>
                <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required class="price_form">
            </div>

            <div style="margin-bottom: 10px;">
                <label>Вес (в граммах):</label><br>
                <input type="number" name="weight" value="{{ old('weight', $product->weight) }}" class="weight_form">
            </div>

            <div style="margin-bottom: 10px;">
                <label>Текущее фото:</label><br>
                @if($product->image_url)
                    <img src="{{ asset('storage/' . $product->image_url) }}" style="width: 100px; height: 100px; object-fit: cover; margin: 5px 0;">
                @else
                    <p style="font-size: 13px; color: #777;">Фото не загружено</p>
                @endif
                <br>
                <label>Заменить фото (необязательно):</label><br>
                <input type="file" name="image" accept="image/*">
            </div>

            <div style="margin-bottom: 15px;">
                <label>
                    <input type="checkbox" name="in_stock" value="1" {{ $product->in_stock ? 'checked' : '' }}> В наличии
                </label>
            </div>

            <button type="submit" class="btn_save_edit">Сохранить изменения</button>
        </form>
    </div>

@endsection
