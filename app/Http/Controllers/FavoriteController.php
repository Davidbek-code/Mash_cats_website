<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::with('product.category')
            ->where('user_id', auth()->id())
            ->get();

        return view('favorites.index', compact('favorites'));
    }

    public function toggle(Product $product)
    {
        $favorite = Favorite::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return back()->with('success', 'Товар убран из избранного.');
        }

        Favorite::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
        ]);

        return back()->with('success', 'Товар добавлен в избранное!');
    }
}
