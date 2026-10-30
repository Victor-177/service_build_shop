@extends('layouts.app')

@section('content')
    <div class="row">
        <!-- Меню категорий (слева) -->
        <div class="col-md-3 mb-4">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action active">Все категории</a>
                @foreach($categories as $category)
                    <a href="#" class="list-group-item list-group-item-action">{{ $category->name }}</a>
                @endforeach
            </div>
        </div>

        <!-- Список услуг (справа) -->
        <div class="col-md-9">
            <h2 class="mb-4">Наши услуги</h2>
            <div class="row row-cols-1 row-cols-md-2 g-4">
                @foreach($services as $service)
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <span class="badge bg-secondary mb-2">{{ $service->category->name }}</span>
                                <h5 class="card-title">{{ $service->name }}</h5>
                                <p class="card-text text-muted">{{ $service->short_description }}</p>
                            </div>
                            <div class="card-footer bg-white border-top-0 d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted">Работа от</small>
                                    <h4 class="mb-0">{{ $service->fixed_price }} ₽</h4>
                                </div>
                                <a href="{{ route('services.show', $service->slug) }}" class="btn btn-primary">Подробнее</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection