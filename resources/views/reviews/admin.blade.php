@extends('layouts.main')

@section('title', 'Создание товара')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/tables.css') }}">
@endpush

@section('content')
<h1 class="admin_title">МОДЕРАЦИЯ ОТЗЫВОВ</h1>
<div class="page-container">
    <div class="page-header">
        <a href="{{ route('reviews.index') }}" class="back-link">← На страницу отзывов</a>
    </div>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-wrapper">
        <table class="custom-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Автор</th>
                <th>Оценка</th>
                <th>Текст отзыва</th>
                <th>Дата</th>
                <th>Статус</th>
            </tr>
            </thead>
            <tbody>
            @forelse($reviews as $review)
                <tr>
                    <td>{{ $review->id }}</td>
                    <td>
                        <strong>{{ $review->user->name ?? 'Неизвестно' }}</strong><br>
                        <span class="author-email">{{ $review->user->email ?? '' }}</span>
                    </td>
                    <td class="review-rating">
                        {{ $review->rating }}
                    </td>
                    <td class="review-text">{{ $review->text }}</td>
                    <td class="review-date">{{ \Carbon\Carbon::parse($review->created_at)->format('d.m.Y') }}</td>
                    <td>
                        <form action="{{ route('reviews.updateStatus', $review) }}" method="POST" class="status-form">
                            @csrf
                            @method('PATCH')

                            <select name="review_status" class="status-select">
                                @foreach(['Новый', 'Опубликован', 'Отклонён'] as $statusOption)
                                    <option value="{{ $statusOption }}" {{ $review->review_status === $statusOption ? 'selected' : '' }}>
                                        {{ $statusOption }}
                                    </option>
                                @endforeach
                            </select>

                            <button type="submit" class="status-btn">ОК</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="empty-message">Отзывов пока нет.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
