<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function show($slug)
    {
        // Ищем услугу по ее slug (ссылка), загружаем категорию и материалы
        $service = Service::where('slug', $slug)
            ->with(['category', 'materials'])
            ->firstOrFail();

        return view('services.show', compact('service'));
    }
}