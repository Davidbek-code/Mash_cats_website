<div style="border: 1px solid #ccc; padding: 15px;">
    @if($product->image_url)
        <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->product_name }}" style="width: 100%; height: 180px; object-fit: cover; margin-bottom: 10px;">
    @else
        <div style="width: 100%; height: 180px; border: 1px dashed #ccc; display: flex; align-items: center; justify-content: center; margin-bottom: 10px; color: #888;">
            Нет фото
        </div>
    @endif

    <h3 style="margin: 0 0 5px 0;">{{ $product->product_name }}</h3>
    <p style="margin: 0 0 5px 0; font-size: 14px; color: #555;">Категория: {{ $product->category->name }}</p>

    @if($product->weight)
        <p style="margin: 0 0 5px 0; font-size: 14px;">Вес: {{ $product->weight }} г</p>
    @endif

    <p style="margin: 0 0 10px 0; font-size: 14px;">{{ $product->description }}</p>

    <p style="font-weight: bold; margin: 0 0 5px 0;">Цена: {{ $product->price }} руб.</p>

    <p style="margin: 0; font-size: 13px; color: {{ $product->in_stock ? 'green' : 'red' }};">
        {{ $product->in_stock ? 'В наличии' : 'Нет в наличии' }}
    </p>

    @auth
        @if($product->in_stock)
            <form action="{{ route('cart.add', $product) }}" method="POST" style="margin-top: 10px;">
                @csrf
                <button type="submit" style="padding: 6px 12px; border: 1px solid #333; background: #f9f9f9; cursor: pointer; width: 100%;">
                    В корзину
                </button>
            </form>
        @endif

            <form action="{{ route('favorites.toggle', $product) }}" method="POST" style="margin-top: 5px;">
                @csrf
                @if(!empty($isFavoritePage))
                    <button type="submit" style="padding: 4px 10px; border: 1px solid red; background: none; color: red; cursor: pointer; width: 100%;">
                        Удалить из избранного
                    </button>
                @elseif(in_array($product->id, $favoriteProductIds))
                    <button type="submit" style="padding: 4px 10px; border: 1px solid #333; background: #eee; font-weight: bold; cursor: pointer; width: 100%;">
                        В избранном
                    </button>
                @else
                    <button type="submit" style="padding: 4px 10px; border: 1px solid #ccc; background: none; cursor: pointer; width: 100%;">
                        В избранное
                    </button>
                @endif
            </form>

        @if(in_array(auth()->user()->role, ['admin', 'manager']))
            <div style="margin-top: 12px; padding-top: 10px; border-top: 1px solid #eee; display: flex; gap: 10px; align-items: center;">
                <a href="{{ route('catalog.edit', $product) }}" style="padding: 4px 10px; border: 1px solid #333; text-decoration: none; color: #000; font-size: 13px;">
                    Изменить
                </a>

                <form action="{{ route('catalog.destroy', $product) }}" method="POST" onsubmit="return confirm('Удалить этот товар?');" style="margin: 0;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="padding: 4px 10px; border: 1px solid red; background: none; color: red; cursor: pointer; font-size: 13px;">
                        Удалить
                    </button>
                </form>
            </div>
        @endif
    @endauth
</div>
