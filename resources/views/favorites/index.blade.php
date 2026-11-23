@extends('layouts.main')

@section('title', 'Создание товара')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/registration.css') }}">
@endpush

@section('content')
    <div style="max-width: 1000px; margin: 20px auto;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h1>Избранные товары</h1>
            <a href="{{ route('catalog.index') }}" style="text-decoration: none; color: #333;">← В каталог</a>
        </div>

        @if(session('success'))
            <div style="padding: 10px; border: 1px solid green; color: green; margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif

        @if($favorites->isEmpty())
            <div style="padding: 20px; border: 1px solid #ccc; text-align: center;">
                <p>В избранном пока пусто.</p>
            </div>
        @else
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px;">
                @foreach($favorites as $fav)
                    @if($fav->product)
                        @include('partials.product_card', ['product' => $fav->product, 'isFavoritePage' => true])
                    @endif
                @endforeach
            </div>
        @endif
    </div>

@endsection
