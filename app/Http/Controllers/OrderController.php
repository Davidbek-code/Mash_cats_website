<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create()
    {
        $cartItems = Cart::with(['product', 'customCake'])
            ->where('user_id', auth()->id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Корзина пуста.');
        }

        $totalPrice = 0;
        foreach ($cartItems as $item) {
            if ($item->product) {
                $totalPrice += $item->product->price * $item->quanity;
            } elseif ($item->customCake) {
                $totalPrice += $item->customCake->total_price * $item->quanity;
            }
        }
        return view('orders.create', compact('cartItems', 'totalPrice'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'delivery_address' => 'required|string|max:255',
            'delivery_time' => 'required|date|after:now',
        ]);

        $cartItems = Cart::with(['product', 'customCake'])
        ->where('user_id', auth()->id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index');
        }

        $totalPrice = 0;
        foreach ($cartItems as $item) {
            if ($item->product) {
                $totalPrice += $item->product->price * $item->quanity;
            } elseif ($item->customCake) {
                $totalPrice += $item->customCake->total_price * $item->quanity;
            }
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => $totalPrice,
            'delivery_address' => $request->delivery_address,
            'status' => 'Новый',
            'delivery_time' => $request->delivery_time,
        ]);

        foreach ($cartItems as $item) {
            $itemPrice = 0;
            if ($item->product) {
                $itemPrice = $item->product->price;
            } elseif ($item->customCake) {
                $itemPrice = $item->customCake->total_price;
            }

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'custom_cake_id' => $item->custom_cake_id,
                'quanity' => $item->quanity,
                'price' => $itemPrice,
            ]);
        }

        Cart::where('user_id', auth()->id())->delete();

        return redirect()->route('catalog.index')->with('success', 'Заказ №' . $order->id . ' успешно оформлен! Ожидайте доставку.');
    }
    public function myOrders()
    {
        $orders = Order::with(['items.product', 'items.customCake'])
            ->where('user_id', auth()->id())
            ->orderBy('id', 'desc')
            ->get();

        return view('orders.my', compact('orders'));
    }
    public function index()
    {
        $orders = Order::with(['user', 'items.product', 'items.customCake'])
            ->orderBy('id', 'desc')
            ->get();

        return view('orders.index', compact('orders'));
    }
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string|in:Новый,Готовится,В доставке,Выполнен,Отменён',
        ]);

        $order->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Статус заказа №' . $order->id . ' обновлён!');
    }

}

