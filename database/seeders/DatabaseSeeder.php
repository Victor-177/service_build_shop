<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Executor;
use App\Models\Material;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Создаем Админа и Клиента
        User::create([
            'username' => 'admin',
            'name' => 'Главный Администратор',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '+7 (999) 111-22-33',
        ]);

        User::create([
            'username' => 'client',
            'name' => 'Иван Клиентов',
            'email' => 'client@example.com',
            'password' => Hash::make('password'),
            'role' => 'client',
            'phone' => '+7 (999) 444-55-66',
        ]);

        // 2. Создаем Категории
        $floors = Category::create(['name' => 'Полы', 'slug' => 'floors']);
        $walls = Category::create(['name' => 'Стены и потолки', 'slug' => 'walls']);
        $electric = Category::create(['name' => 'Электрика', 'slug' => 'electric']);

        // 3. Создаем Материалы
        $laminat = Material::create(['name' => 'Ламинат 33 класс', 'unit' => 'м2', 'price_per_unit' => 1200.00]);
        $tile = Material::create(['name' => 'Керамическая плитка', 'unit' => 'м2', 'price_per_unit' => 1800.00]);
        $cable = Material::create(['name' => 'Кабель ВВГнг', 'unit' => 'пог.м', 'price_per_unit' => 80.00]);

        // 4. Создаем Услуги
        $service1 = Service::create([
            'category_id' => $floors->id,
            'name' => 'Укладка ламината',
            'slug' => 'ukladka-laminata',
            'short_description' => 'Быстрая и качественная укладка ламината.',
            'description' => 'Подготовка основания, укладка подложки и ламината.',
            'fixed_price' => 500.00, // Фиксированная часть (работа)
            'duration' => '1-2 дня',
            'is_active' => true,
        ]);
        $service1->materials()->attach($laminat->id);

        $service2 = Service::create([
            'category_id' => $floors->id,
            'name' => 'Укладка плитки',
            'slug' => 'ukladka-plitki',
            'short_description' => 'Профессиональная укладка плитки.',
            'description' => 'Укладка керамической плитки на пол.',
            'fixed_price' => 800.00,
            'duration' => '2-3 дня',
            'is_active' => true,
        ]);
        $service2->materials()->attach($tile->id);

        $service3 = Service::create([
            'category_id' => $electric->id,
            'name' => 'Разводка электрики',
            'slug' => 'razvodka-elektriki',
            'short_description' => 'Штробление стен и прокладка кабеля.',
            'description' => 'Полная замена или монтаж новой электропроводки.',
            'fixed_price' => 2000.00,
            'duration' => '3-5 дней',
            'is_active' => true,
        ]);
        $service3->materials()->attach($cable->id);

        // 5. Создаем Бригаду
        $executor = Executor::create([
            'name' => 'Бригада "Мастер на час"',
            'description' => 'Опытные мастера с опытом работы более 10 лет.',
            'phone' => '+7 (999) 777-88-99',
            'email' => 'master@example.com',
            'is_active' => true,
        ]);
        $executor->categories()->attach([$floors->id, $electric->id]);
    }
}