@extends('layouts.main')

@section('title', 'Создание товара')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/registration.css') }}">
@endpush

@section('content')
<h1 class="registration_title">ОТЗЫВЫ</h1>
<div style="max-width: 800px; margin: 20px auto;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <div style="display: flex; gap: 15px; align-items: center;">
            @auth
                @if(in_array(auth()->user()->role, ['admin', 'manager']))
                    <a href="{{ route('reviews.admin') }}" style="padding: 6px 12px; border: 1px solid #333; text-decoration: none; color: #000;">
                        Модерация отзывов
                    </a>
                @endif
            @endauth
            <a href="{{ route('catalog.index') }}" style="text-decoration: none; color: #333;">← В каталог</a>
        </div>
    </div>

    @if(session('success'))
        <div style="padding: 10px; border: 1px solid green; color: green; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Форма добавления отзыва (только для авторизованных) -->
    @auth
        @if($hasReviewed)
            <div style="border: 1px solid #ccc; padding: 15px; margin-bottom: 25px; background: #fafafa; text-align: center;">
                <p style="margin: 0;">Вы уже оставили отзыв. Спасибо за ваше мнение!</p>
            </div>
        @else
            <div style="border: 1px solid #ccc; padding: 15px; margin-bottom: 25px; background: #fafafa;">
                <h3 style="margin: 0 0 10px 0;">Оставить отзыв</h3>

                @if ($errors->any())
                    <div style="color: red; margin-bottom: 10px;">
                        <ul style="margin: 0;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('reviews.store') }}" method="POST">
                    @csrf

                    <div style="margin-bottom: 10px;">
                        <label>Ваша оценка:</label><br>
                        <select name="rating" required style="padding: 5px; margin-top: 5px;">
                            <option value="5">★★★★★ (5 — Отлично)</option>
                            <option value="4">★★★★☆ (4 — Хорошо)</option>
                            <option value="3">★★★☆☆ (3 — Нормально)</option>
                            <option value="2">★★☆☆☆ (2 — Плохо)</option>
                            <option value="1">★☆☆☆☆ (1 — Ужасно)</option>
                        </select>
                    </div>

                    <div style="margin-bottom: 10px;">
                        <label>Текст отзыва:</label><br>
                        <textarea name="text" rows="3" required placeholder="Поделитесь впечатлениями о тортах и доставке..." style="width: 100%; padding: 8px; margin-top: 5px;"></textarea>
                    </div>

                    <button type="submit" style="padding: 8px 15px; border: 1px solid #000; background: #eee; cursor: pointer;">
                        Отправить отзыв
                    </button>
                </form>
            </div>
        @endif
    @else
        <div style="border: 1px solid #ccc; padding: 15px; margin-bottom: 25px; text-align: center;">
            <p style="margin: 0;">Чтобы оставить отзыв, пожалуйста, <a href="{{ route('login') }}">войдите в аккаунт</a>.</p>
        </div>
    @endauth

    <!-- Список опубликованных отзывов -->
    <div style="display: flex; flex-direction: column; gap: 15px;">
        @forelse($reviews as $review)
            <div style="border: 1px solid #ccc; padding: 15px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                    <strong>{{ $review->user->name ?? 'Пользователь' }}</strong>
                    <span style="color: #e6a800; font-size: 18px; letter-spacing: 2px;">
                        {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                    </span>
                </div>
                <p style="margin: 0 0 8px 0; font-size: 15px;">{{ $review->text }}</p>
                <span style="font-size: 12px; color: #777;">{{ \Carbon\Carbon::parse($review->created_at)->format('d.m.Y') }}</span>
{{--                форматироание даты--}}
            </div>
        @empty
            <p style="text-align: center; color: #666;">Пока нет опубликованных отзывов. Будьте первым!</p>
        @endforelse
    </div>
</div>
@endsection
