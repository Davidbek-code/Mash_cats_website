<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Создание пользователей с разными ролями (пароль у всех: 12345678)
        $admin = User::create([
            'name' => 'Администратор',
            'surname' => 'Системный',
            'patronymic' => 'Иванович',
            'phone' => '+79001112233',
            'email' => 'admin@mail.com',
            'password' => Hash::make('QWEasd123'),
            'role' => 'admin',
        ]);

        $manager = User::create([
            'name' => 'Менеджер Анна',
            'surname' => 'Системная',
            'patronymic' => 'Ивановна',
            'phone' => '+79001112233',
            'email' => 'manager@mail.com',
            'password' => Hash::make('QWEasd123'),
            'role' => 'manager',
        ]);

        $user1 = User::create([
            'name' => 'Никита',
            'surname' => 'Фуриев',
            'patronymic' => 'Олегович',
            'phone' => '+79001112233',
            'email' => 'user@mail.com',
            'password' => Hash::make('QWEasd123'),
            'role' => 'user',
        ]);

        $user2 = User::create([
            'name' => 'Елена',
            'surname' => 'Кошкина',
            'patronymic' => 'Владимировна',
            'phone' => '+79001112233',
            'email' => 'elena@mail.com',
            'password' => Hash::make('QWEasd123'),
            'role' => 'user',
        ]);

        // 2. Создание категорий
        $cakes = Category::create(['name' => 'Торты']);
        $pastries = Category::create(['name' => 'Пирожные']);
        $bakery = Category::create(['name' => 'Выпечка']);

        // 3. Создание товаров (вес в граммах)
        Product::create([
            'category_id' => $cakes->id,
            'product_name' => 'Медовик классический',
            'description' => 'Нежные медовые коржи с натуральным сметанным кремом.',
            'price' => 1450.00,
            'image_url' => 'products/medovik.jpg',
            'in_stock' => true,
            'weight' => 1100,
        ]);

        Product::create([
            'category_id' => $cakes->id,
            'product_name' => 'Красный бархат',
            'description' => 'Влажный шоколадно-сливочный бисквит с кремом на основе творожного сыра.',
            'price' => 1890.00,
            'image_url' => 'products/red_barhat.jpg',
            'in_stock' => true,
            'weight' => 1300,
        ]);

        Product::create([
            'category_id' => $cakes->id,
            'product_name' => 'Наполеон домашний',
            'description' => 'Хрустящие слоёные коржи с заварным ванильным кремом.',
            'price' => 1600.00,
            'image_url' => 'products/napaleon.jpg',
            'in_stock' => false,
            'weight' => 1200,
        ]);

        Product::create([
            'category_id' => $pastries->id,
            'product_name' => 'Эклер ванильный (набор 4 шт.)',
            'description' => 'Заварное тесто с нежным сливочно-ванильным кремом и глазурью.',
            'price' => 680.00,
            'image_url' => 'products/eclair.jpeg',
            'in_stock' => true,
            'weight' => 320,
        ]);

        Product::create([
            'category_id' => $pastries->id,
            'product_name' => 'Картошка шоколадная (3 шт.)',
            'description' => 'Классическое бисквитное пирожное с какао и сливочным маслом.',
            'price' => 450.00,
            'image_url' => 'products/potato.jpg',
            'in_stock' => true,
            'weight' => 270,
        ]);

        Product::create([
            'category_id' => $bakery->id,
            'product_name' => 'Круассан с миндальным кремом',
            'description' => 'Свежая слоёная выпечка с миндальной начинкой и лепестками миндаля.',
            'price' => 290.00,
            'image_url' => 'products/croissant.jpg',
            'in_stock' => true,
            'weight' => 140,
        ]);

        // 4. Создание отзывов
        Review::create([
            'user_id' => $user1->id,
            'rating' => 5,
            'text' => 'Заказывали Медовик на день рождения — доставили вовремя, торт свежайший и очень вкусный!',
            'review_status' => 'Опубликован',
        ]);

        Review::create([
            'user_id' => $user2->id,
            'rating' => 4,
            'text' => 'Эклеры отличные, крем не приторный. Хотелось бы побольше вариантов начинок в конструкторе.',
            'review_status' => 'Опубликован',
        ]);

        Review::create([
            'user_id' => $admin->id,
            'rating' => 5,
            'text' => 'Тестовый новый отзыв для проверки модерации администратором.',
            'review_status' => 'Новый',
        ]);
    }
}
