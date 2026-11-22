@extends('layouts.main')

@section('title', 'Личный кабинет')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/services.css') }}">
@endpush

@section('content')

<h1 class="services_title">КОНСТРУКТОР ТОРТОВ</h1>

<div style="max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #ccc;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
        <a href="{{ route('catalog.index') }}" style="text-decoration: none; color: #333;">← В каталог</a>
    </div>

@if ($errors->any())
    <div style="color: red; margin-bottom: 15px;">
        <ul style="margin: 0;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('custom_cakes.store') }}" method="POST" id="cake-form">
    @csrf

    <div style="margin-bottom: 15px;">
        <label><strong>1. Выберите бисквит:</strong></label><br>
        <select name="biscuit_type" id="biscuit" style="width: 100%; padding: 8px; margin-top: 5px;">
            @foreach($biscuits as $name => $price)
                <option value="{{ $name }}" data-price="{{ $price }}">
                    {{ $name }} (+{{ $price }} руб.)
                </option>
            @endforeach
        </select>
    </div>

    <div style="margin-bottom: 15px;">
        <label><strong>2. Выберите крем:</strong></label><br>
        <select name="cream_type" id="cream" style="width: 100%; padding: 8px; margin-top: 5px;">
            @foreach($creams as $name => $price)
                <option value="{{ $name }}" data-price="{{ $price }}">
                    {{ $name }} (+{{ $price }} руб.)
                </option>
            @endforeach
        </select>
    </div>

    <div style="margin-bottom: 15px;">
        <label><strong>3. Выберите начинку:</strong></label><br>
        <select name="filling_type" id="filling" style="width: 100%; padding: 8px; margin-top: 5px;">
            @foreach($fillings as $name => $price)
                <option value="{{ $name }}" data-price="{{ $price }}">
                    {{ $name }} (+{{ $price }} руб.)
                </option>
            @endforeach
        </select>
    </div>

    <div style="margin-bottom: 20px;">
        <label><strong>4. Надпись на торте (необязательно, до 25 символов, +{{ $decorPrice }} руб.):</strong></label><br>
        <input type="text" name="decor_text" id="decor" maxlength="25" placeholder="Например: С Днём Рождения!" style="width: 100%; padding: 8px; margin-top: 5px;">
    </div>

    <!-- Блок расчёта цены -->
    <div style="padding: 15px; border: 1px solid #333; background: #f9f9f9; margin-bottom: 15px; text-align: center;">
        <span style="font-size: 16px;">Итоговая стоимость торта: </span>
        <strong id="total-price" style="font-size: 20px;">0</strong> <strong>руб.</strong>
    </div>

    <button type="submit" style="width: 100%; padding: 10px; border: 1px solid #000; background: #eee; font-weight: bold; cursor: pointer;">
        Добавить торт в корзину
    </button>
</form>
</div>

<script>
    const biscuitSelect = document.getElementById('biscuit');
    const creamSelect = document.getElementById('cream');
    const fillingSelect = document.getElementById('filling');
    const decorInput = document.getElementById('decor');
    const totalSpan = document.getElementById('total-price');
    const decorCost = {{ $decorPrice }};

    function calculatePrice() {
        const bPrice = Number(biscuitSelect.options[biscuitSelect.selectedIndex].dataset.price);
        const cPrice = Number(creamSelect.options[creamSelect.selectedIndex].dataset.price);
        const fPrice = Number(fillingSelect.options[fillingSelect.selectedIndex].dataset.price);
        const dPrice = decorInput.value.trim() !== '' ? decorCost : 0;

        totalSpan.textContent = bPrice + cPrice + fPrice + dPrice;
    }

    biscuitSelect.addEventListener('change', calculatePrice);
    creamSelect.addEventListener('change', calculatePrice);
    fillingSelect.addEventListener('change', calculatePrice);
    decorInput.addEventListener('input', calculatePrice);

    calculatePrice();
</script>

@endsection
