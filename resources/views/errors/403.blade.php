@extends('layouts.main')

@section('title', 'Страница не найдена — 404')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/errors.css') }}">
@endpush

@section('content')
    <div class="error_container">
        <h1 class="error_title">ОШИБКА 403</h1>
        <img src="{{ asset('img/error.png') }}" alt="error403">
        <p class="error_text">Доступ запрещён</p>
    </div>
@endsection
