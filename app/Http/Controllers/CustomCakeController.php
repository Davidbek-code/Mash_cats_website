<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CustomCake;
use Illuminate\Http\Request;

class CustomCakeController extends Controller
{
    // Справочник цен на ингредиенты
    private array $biscuits = [
        'Ванильный' => 800,
        'Шоколадный' => 950,
        'Красный бархат' => 1100,
        'Медовый' => 900,
    ];

    private array $creams = [
        'Крем-чиз' => 500,
        'Сметанный' => 400,
        'Шоколадный ганаш' => 650,
        'Заварной' => 450,
    ];

    private array $fillings = [
        'Клубника' => 350,
        'Вишня' => 350,
        'Солёная карамель и арахис' => 400,
        'Без начинки' => 0,
    ];

    private int $decorPrice = 250; // Доплата за надпись на торте

    // Показ страницы конструктора
    public function create()
    {
        return view('custom_cakes.create', [
            'biscuits' => $this->biscuits,
            'creams' => $this->creams,
            'fillings' => $this->fillings,
            'decorPrice' => $this->decorPrice,
        ]);
    }

    // Сохранение кастомного торта и добавление в корзину
    public function store(Request $request)
    {
        $request->validate([
            'biscuit_type' => 'required|in:' . implode(',', array_keys($this->biscuits)),
            'cream_type' => 'required|in:' . implode(',', array_keys($this->creams)),
            'filling_type' => 'required|in:' . implode(',', array_keys($this->fillings)),
            'decor_text' => 'nullable|string|max:100',
        ]);

        // Считаем итоговую стоимость на сервере
        $totalPrice = $this->biscuits[$request->biscuit_type]
            + $this->creams[$request->cream_type]
            + $this->fillings[$request->filling_type];

        if ($request->filled('decor_text')) {
            $totalPrice += $this->decorPrice;
        }

        // 1. Создаём запись кастомного торта
        $customCake = CustomCake::create([
            'user_id' => auth()->id(),
            'biscuit_type' => $request->biscuit_type,
            'cream_type' => $request->cream_type,
            'filling_type' => $request->filling_type,
            'decor_text' => $request->decor_text,
            'total_price' => $totalPrice,
        ]);

        // 2. Сразу добавляем его в корзину пользователя
        Cart::create([
            'user_id' => auth()->id(),
            'custom_cake_id' => $customCake->id,
            'quanity' => 1,
        ]);

        return redirect()->route('cart.index')->with('success', 'Ваш уникальный торт собран и добавлен в корзину!');
    }
}
