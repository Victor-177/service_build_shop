@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Оформление заказа</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-md-7">
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title mb-4">Данные для связи</h4>
                    <form action="{{ route('cart.process') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="address" class="form-label">Адрес объекта</label>
                            <input type="text" name="address" id="address" class="form-control" value="{{ old('address', Auth::user()->address ?? '') }}" required placeholder="Город, улица, дом, квартира">
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Телефон для связи</label>
                            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', Auth::user()->phone ?? '') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="preferred_date" class="form-label">Желаемая дата начала работ</label>
                            <input type="date" name="preferred_date" id="preferred_date" class="form-control" value="{{ old('preferred_date') }}">
                        </div>

                        <div class="mb-3">
                            <label for="comment" class="form-label">Комментарий к заказу</label>
                            <textarea name="comment" id="comment" class="form-control" rows="3">{{ old('comment') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-warning btn-lg w-100 fw-bold">Подтвердить заказ</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-4">Ваш заказ</h4>
                    @foreach($cartItems as $item)
                        <div class="d-flex justify-content-between mb-2">
                            <span>{{ $item->service->name }} ({{ $item->quantity }} ед.)</span>
                            <span>{{ ($item->service->fixed_price + ($item->material ? $item->material->price_per_unit * $item->quantity : 0)) * $item->quantity }} ₽</span>
                        </div>
                    @endforeach
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span class="fs-5 fw-bold">Итого:</span>
                        <span class="fs-5 fw-bold">{{ $total }} ₽</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection