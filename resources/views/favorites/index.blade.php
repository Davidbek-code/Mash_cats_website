@extends('layouts.main')

@section('title', 'Избранное')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/catalog.css') }}">
@endpush

@section('content')
    <div style="max-width: 1000px; margin: 20px auto;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h1>ИЗБРАННОЕ</h1>
            <a href="{{ route('catalog.index') }}" style="text-decoration: none; color: #3C3C3C;">← В каталог</a>
        </div>

        @if(session('success'))
            <div class="success_message">
                {{ session('success') }}
            </div>
        @endif

        @if($favorites->isEmpty())
            <div class="favorites_empty_message">
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
