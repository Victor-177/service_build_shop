@extends('layouts.app')

@section('content')
    <div class="text-center mt-5">
        <h1 class="text-success mb-4">Спасибо за заказ!</h1>
        <p class="fs-4">Ваш заказ <strong>№{{ $order->id }}</strong> успешно создан.</p>
        <p class="text-muted">Наш менеджер свяжется с вами в ближайшее время.</p>
        <a href="{{ route('home') }}" class="btn btn-primary mt-4">Вернуться на главную</a>
    </div>
@endsection