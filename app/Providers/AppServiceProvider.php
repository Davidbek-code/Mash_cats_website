<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Favorite;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            $favoriteProductIds = auth()->check()
                ? Favorite::where('user_id', auth()->id())->pluck('product_id')->toArray()
                : [];

            $view->with('favoriteProductIds', $favoriteProductIds);
        });
    }
}
