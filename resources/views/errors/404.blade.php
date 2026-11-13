@extends('layouts.main')

@section('title', 'Страница не найдена — 404')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/errors.css') }}">
@endpush

@section('content')
    <div class="error_container">
        <h1 class="error_title">ОШИБКА 404</h1>
        <img src="{{ asset('img/error.png') }}" alt="error404">
        <p class="error_text">Такой страницы не существует</p>
    </div>
@endsection
