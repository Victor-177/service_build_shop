<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Берем все активные услуги вместе с их категориями
        $services = Service::where('is_active', true)->with('category')->get();
        // Берем все категории для меню
        $categories = Category::all();

        // Передаем данные в шаблон (файл resources/views/index.blade.php)
        return view('index', compact('services', 'categories'));
    }
}