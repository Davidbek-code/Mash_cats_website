@extends('layouts.main')

@section('title', 'Конструктор тортов')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/custom_cake.css') }}">
@endpush

@section('content')

<h1 class="services_title">КОНСТРУКТОР ТОРТОВ</h1>

<div class="custom_cake_container">

@if ($errors->any())
    <div class="errors">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('custom_cakes.store') }}" method="POST" id="cake-form">
    @csrf

    <div class='cake_compomnent'>
        <label><strong>1. Выберите бисквит</strong></label><br>
        <select name="biscuit_type" id="biscuit">
            @foreach($biscuits as $name => $price)
                <option value="{{ $name }}" data-price="{{ $price }}">
                    {{ $name }} (+{{ $price }} руб.)
                </option>
            @endforeach
        </select>
    </div>

    <div class='cake_compomnent'>
        <label><strong>2. Выберите крем</strong></label><br>
        <select name="cream_type" id="cream">
            @foreach($creams as $name => $price)
                <option value="{{ $name }}" data-price="{{ $price }}">
                    {{ $name }} (+{{ $price }} руб.)
                </option>
            @endforeach
        </select>
    </div>

    <div class='cake_compomnent'>
        <label><strong>3. Выберите начинку</strong></label><br>
        <select name="filling_type" id="filling">
            @foreach($fillings as $name => $price)
                <option value="{{ $name }}" data-price="{{ $price }}">
                    {{ $name }} (+{{ $price }} руб.)
                </option>
            @endforeach
        </select>
    </div>

    <div class='cake_compomnent'>
        <label><strong>4. Надпись на торте (необязательно, до 25 символов)</strong></label><br>
        <input type="text" name="decor_text" id="decor" maxlength="25" placeholder="Например: С Днём Рождения!">
    </div>

    <div class="cake_total_price_container">
        <span class="cake_total_price_text">Итоговая стоимость торта: </span>
        <strong id="total-price">0</strong> <strong class="cake_total_price_text">руб</strong>
    </div>

    <button type="submit" class="btn_to_cart">
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
