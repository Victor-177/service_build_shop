@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <a href="{{ route('home') }}" class="text-decoration-none">&larr; Назад в каталог</a>
    </div>

    <div class="row">
        <!-- Левая часть: Описание -->
        <div class="col-md-7">
            <h1 class="display-5">{{ $service->name }}</h1>
            <p class="text-muted lead">{{ $service->short_description }}</p>
            
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">Описание услуги</h4>
                    <p class="card-text">{{ $service->description ?? 'Подробное описание пока не добавлено.' }}</p>
                    <p class="mb-0"><strong>Срок выполнения:</strong> {{ $service->duration ?? 'Не указан' }}</p>
                </div>
            </div>
        </div>

        <!-- Правая часть: Цена и Материалы -->
        <div class="col-md-5">
            <div class="card shadow-sm sticky-top" style="top: 20px;">
                <div class="card-body">
                    <h2 class="mb-3">{{ $service->fixed_price }} ₽ <small class="text-muted fs-6">/ работа</small></h2>
                    
                    @if($service->materials->count() > 0)
                        <h5 class="mt-4">Доступные материалы</h5>
                        <p class="text-muted small">Итоговая цена рассчитывается индивидуально в корзине.</p>
                        
                        <ul class="list-group mb-4">
                            @foreach($service->materials as $material)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $material->name }}
                                    <span class="badge bg-primary rounded-pill">{{ $material->price_per_unit }} ₽ / {{ $material->unit }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <form action="{{ route('cart.add', $service->id) }}" method="POST">
    @csrf
    <!-- Выбор материала (если они есть) -->
    @if($service->materials->count() > 0)
        <div class="mb-3">
            <label class="form-label">Выберите материал:</label>
            <select name="material_id" class="form-select">
                <option value="">Без материала (только работа)</option>
                @foreach($service->materials as $material)
                    <option value="{{ $material->id }}">{{ $material->name }} (+{{ $material->price_per_unit }} ₽ / {{ $material->unit }})</option>
                @endforeach
            </select>
        </div>
    @endif

    <div class="mb-3">
        <label class="form-label">Объем (кол-во)</label>
        <input type="number" name="quantity" class="form-control" value="1" min="1" step="0.1" required>
    </div>

    <button type="submit" class="btn btn-warning btn-lg w-100 fw-bold">Добавить в корзину</button>
</form>
                </div>
            </div>
        </div>
    </div>
@endsection