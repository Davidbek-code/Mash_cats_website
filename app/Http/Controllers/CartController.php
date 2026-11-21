<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Просмотр корзины
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        // Считаем общую сумму заказа
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            if ($item->product) {
                $totalPrice += $item->product->price * $item->quanity;
            }
            // Позже сюда добавится: elseif ($item->customCake) { ... }
        }

        return view('cart.index', compact('cartItems', 'totalPrice'));
    }

    // Добавление обычного товара в корзину
    public function addProduct(Product $product)
    {
        if (!$product->in_stock) {
            return back()->with('error', 'Товара нет в наличии.');
        }

        // Проверяем, есть ли уже такой товар в корзине пользователя
        $cartItem = Cart::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quanity');
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quanity' => 1,
            ]);
        }

        return back()->with('success', 'Товар добавлен в корзину!');
    }

    // Изменение количества (+1 или -1)
    public function updateQuantity(Request $request, Cart $cart)
    {
        // Защита, чтобы нельзя было менять чужую корзину
        if ($cart->user_id !== auth()->id()) {
            abort(403);
        }

        if ($request->action === 'increase') {
            $cart->increment('quanity');
        } elseif ($request->action === 'decrease') {
            if ($cart->quanity > 1) {
                $cart->decrement('quanity');
            } else {
                $cart->delete();
            }
        }

        return back();
    }

    // Удаление позиции из корзины
    public function destroy(Cart $cart)
    {
        if ($cart->user_id !== auth()->id()) {
            abort(403);
        }

        $cart->delete();

        return back()->with('success', 'Позиция удалена из корзины.');
    }
}
