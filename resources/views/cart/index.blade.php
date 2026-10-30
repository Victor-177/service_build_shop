@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Корзина</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($cartItems->isEmpty())
        <div class="alert alert-info">
            Ваша корзина пуста. <a href="{{ route('home') }}">Перейти к услугам</a>.
        </div>
    @else
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-body">
                        @foreach($cartItems as $item)
                            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                <div>
                                    <h5 class="mb-1">{{ $item->service->name }}</h5>
                                    <p class="text-muted mb-1">
                                        Объем: {{ $item->quantity }} ед.
                                        @if($item->material)
                                            (Материал: {{ $item->material->name }})
                                        @endif
                                    </p>
                                    <h6 class="mb-0">{{ $item->calculated_total }} ₽</h6>
                                </div>
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Удалить</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Итого</h4>
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fs-5">Сумма:</span>
                            <span class="fs-4 fw-bold">{{ $total }} ₽</span>
                        </div>
                        <a href="{{ route('cart.checkout') }}" class="btn btn-warning btn-lg w-100">Оформить заказ</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection