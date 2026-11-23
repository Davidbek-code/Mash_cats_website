<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // 1. Публичная страница отзывов (показываем только "Опубликован")
    public function index()
    {
        $reviews = Review::with('user')
            ->where('review_status', 'Опубликован')
            ->orderBy('id', 'desc')
            ->get();

        // Проверяем, оставлял ли текущий пользователь уже отзыв (кроме отклонённых)
        $hasReviewed = auth()->check()
            ? Review::where('user_id', auth()->id())->where('review_status', '!=', 'Отклонён')->exists()
            : false;

        return view('reviews.index', compact('reviews', 'hasReviewed'));
    }

    // 2. Сохранение нового отзыва от пользователя
    public function store(Request $request)
    {
        $alreadyExists = Review::where('user_id', auth()->id())
            ->where('review_status', '!=', 'Отклонён')
            ->exists();

        if ($alreadyExists) {
            return back()->with('error', 'Вы уже оставили отзыв о нашей кондитерской.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'text' => 'required|string|max:1000',
        ]);

        Review::create([
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'text' => $request->text,
            'review_status' => 'Новый',
        ]);

        return back()->with('success', 'Спасибо! Ваш отзыв отправлен на модерацию.');
    }

    // 3. Страница модерации для админа и менеджера
    public function adminIndex()
    {
        $reviews = Review::with('user')
            ->orderBy('id', 'desc')
            ->get();

        return view('reviews.admin', compact('reviews'));
    }

    // 4. Смена статуса отзыва ("Опубликован" или "Отклонён")
    public function updateStatus(Request $request, Review $review)
    {
        $request->validate([
            'review_status' => 'required|in:Новый,Опубликован,Отклонён',
        ]);

        $review->update([
            'review_status' => $request->review_status,
        ]);

        return back()->with('success', 'Статус отзыва №' . $review->id . ' обновлён!');
    }
}
