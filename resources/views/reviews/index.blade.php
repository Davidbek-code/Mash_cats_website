@extends('layouts.main')

@section('title', 'Отзывы')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/reviews.css') }}">
@endpush

@section('content')
<h1 class="reviews_title">ОТЗЫВЫ</h1>
<div class="review_container">
    <div class="reviews_bar">
{{--        <div style="display: flex; gap: 15px; align-items: center;">--}}
            @auth
                @if(in_array(auth()->user()->role, ['admin', 'manager']))
                    <a href="{{ route('reviews.admin') }}" class="review_to_admin">
                        Модерация отзывов
                    </a>
                @endif
            @endauth
            <a href="{{ route('catalog.index') }}" style="text-decoration: none; color: #333;">← В каталог</a>
{{--        </div>--}}
    </div>

    @if(session('success'))
        <div style="padding: 10px; border: 1px solid green; color: green; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    @auth
        @if($hasReviewed)
            <div class="reviews_yet">
                <p style="margin: 0;">Вы уже оставили отзыв. Спасибо за ваше мнение!</p>
            </div>
        @else
            <div class="make_review_container">
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

                    <div class="rate_container">
                        <label>Ваша оценка:</label><br>
                        <select class='rate' name="rating" required>
                            <option value="5">★★★★★ (5 — Отлично)</option>
                            <option value="4">★★★★☆ (4 — Хорошо)</option>
                            <option value="3">★★★☆☆ (3 — Нормально)</option>
                            <option value="2">★★☆☆☆ (2 — Плохо)</option>
                            <option value="1">★☆☆☆☆ (1 — Ужасно)</option>
                        </select>
                    </div>

                    <div style="margin-bottom: 10px;">
                        <label>Текст отзыва:</label><br>
                        <textarea name="text" rows="3" required placeholder="Поделитесь впечатлениями..." class="rate_textarea"></textarea>
                    </div>

                    <button type="submit" class="btn_rate_send">
                        Отправить отзыв
                    </button>
                </form>
            </div>
        @endif
    @else
        <div class="auth_message">
            <p>Чтобы оставить отзыв, пожалуйста, войдите в аккаунт.</p>
        </div>
    @endauth

    <div class="reviews_item_container">
        @forelse($reviews as $review)
            <div class="reviews_item">
                <div class="reviews_item_bar">
                    <strong class="reviews_user_name">{{ $review->user->name ?? 'Пользователь' }}</strong>
                    <span class="rate_stars">
                        {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                    </span>
                </div>
                <p class="reviews_item_text">{{ $review->text }}</p>
                <span class="reviews_item_date">{{ \Carbon\Carbon::parse($review->created_at)->format('d.m.Y') }}</span>
            </div>
        @empty
            <p class="reviews_empty">Пока нет опубликованных отзывов. Будьте первым!</p>
        @endforelse
    </div>
</div>
@endsection
