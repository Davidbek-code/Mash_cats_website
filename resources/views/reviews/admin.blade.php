@extends('layouts.main')

@section('title', 'Создание товара')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/registration.css') }}">
@endpush

@section('content')
<h1 class="registration_title">МОДЕРАЦИЯ ОТЗЫВОВ</h1>
<div style="max-width: 1000px; margin: 20px auto;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <a href="{{ route('reviews.index') }}" style="text-decoration: none; color: #333;">← На страницу отзывов</a>
    </div>

    @if(session('success'))
        <div style="padding: 10px; border: 1px solid green; color: green; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
        <thead>
        <tr style="background: #f4f4f4;">
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
                    <span style="font-size: 12px; color: #555;">{{ $review->user->email ?? '' }}</span>
                </td>
                <td style="color: #e6a800; font-size: 16px;">
                    {{ str_repeat('★', $review->rating) }} ({{ $review->rating }})
                </td>
                <td style="max-width: 350px;">{{ $review->text }}</td>
                <td style="font-size: 12px;">{{ \Carbon\Carbon::parse($review->created_at)->format('d.m.Y') }}</td>
                <td>
                    <form action="{{ route('reviews.updateStatus', $review) }}" method="POST" style="display: flex; gap: 5px; margin: 0;">
                        @csrf
                        @method('PATCH')

                        <select name="review_status" style="padding: 4px;">
                            @foreach(['Новый', 'Опубликован', 'Отклонён'] as $statusOption)
                                <option value="{{ $statusOption }}" {{ $review->review_status === $statusOption ? 'selected' : '' }}>
                                    {{ $statusOption }}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit" style="padding: 4px 8px; cursor: pointer;">ОК</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" style="text-align: center;">Отзывов пока нет.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

@endsection
