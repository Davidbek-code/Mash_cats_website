<div style="border: 2px solid #FF9595; padding: 20px; border-radius: 20px; display: flex; flex-direction: column; justify-content: space-between; height: 100%; box-sizing: border-box;">

    <div>
        @if($product->image_url)
            <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->product_name }}" style="width: 100%; height: 180px; object-fit: cover; margin-bottom: 10px; border-radius: 20px;">
        @else
            <div style="width: 100%; height: 180px; border: 1px dashed #ccc; display: flex; align-items: center; justify-content: center; margin-bottom: 10px; color: #888; border-radius: 20px;">
                Нет фото
            </div>
        @endif

        <h3 style="margin: 0 0 5px 0; font-size: 18px; color:#FF9595; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
            {{ $product->product_name }}
        </h3>

        {{-- <p style="margin: 0 0 5px 0; font-size: 14px; color: #555;">Категория: {{ $product->category->name }}</p> --}}

        @if($product->weight)
            <p style="margin: 0 0 5px 0; font-size: 14px; color:#3C3C3C;">Вес: {{ $product->weight }} г</p>
        @endif

        <p style="margin: 0 0 15px 0; font-size: 12px; color:#FF9595; line-height: 1.4;">
            {{ $product->description }}
        </p>
    </div>

    <div style="margin-top: auto;">
        <p style="font-weight: 700; font-size: 18px; margin: 0 0 5px 0; color:#FF9595;">
            Цена: {{ $product->price }} руб
        </p>

        <p style="margin: 0; font-size: 12px; color: {{ $product->in_stock ? 'green' : 'red' }};">
            {{ $product->in_stock ? 'В наличии' : 'Нет в наличии' }}
        </p>

        @auth
            @if($product->in_stock)
                <form action="{{ route('cart.add', $product) }}" method="POST" style="margin-top: 10px;">
                    @csrf
                    <button type="submit" style="padding: 9px 12px; color: white; background: #FF9595; border: none; cursor: pointer; width: 100%; border-radius: 10px; font-weight: 550; font-size: 16px; box-shadow:none;">
                        В корзину
                    </button>
                </form>
            @endif

            <form action="{{ route('favorites.toggle', $product) }}" method="POST" style="margin-top: 5px;">
                @csrf
                @if(!empty($isFavoritePage))
                    <button type="submit" style="padding: 9px 10px; border: 1px solid red; background: none; width: 100%; border-radius: 10px; cursor: pointer; font-size: 15px; color:#3C3C3C;">
                        Удалить из избранного
                    </button>
                @elseif(in_array($product->id, $favoriteProductIds))
                    <button type="submit" style="padding: 7px 10px; border: 2px solid #FF9595; background: none; width: 100%; border-radius: 10px; cursor: pointer; font-size: 15px; color:#3C3C3C;">
                        В избранном
                    </button>
                @else
                    <button type="submit" style="padding: 7px 10px; border: 2px solid #FF9595; background: none; width: 100%; border-radius: 10px; cursor: pointer; font-size: 15px; color:#3C3C3C;">
                        В избранное
                    </button>
                @endif
            </form>

            @if(in_array(auth()->user()->role, ['admin', 'manager']))
                <div style="margin-top: 12px; padding-top: 10px; border-top: 1px solid #eee; display: flex; gap: 10px; align-items: center;">
                    <a href="{{ route('catalog.edit', $product) }}" style="padding: 4px 10px; border: 1px solid #3C3C3C; text-decoration: none; color:#3C3C3C; font-size: 13px; border-radius: 8px;">
                        Изменить
                    </a>
                    <form action="{{ route('catalog.destroy', $product) }}" method="POST" onsubmit="return confirm('Удалить этот товар?');" style="margin: 0;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="padding: 4px 12px; border: 1px solid red; background: none; color: red; cursor: pointer; font-size: 13px; border-radius: 8px;">
                            Удалить
                        </button>
                    </form>
                </div>
            @endif
        @endauth
    </div>

</div>
