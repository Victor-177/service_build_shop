<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Показать корзину
    public function index()
    {
        $cartItems = CartItem::with(['service', 'material'])
            ->where('user_id', Auth::id())
            ->get();
            
        $total = 0;
        foreach ($cartItems as $item) {
            // Считаем цену: фикс + (цена материала * кол-во)
            $materialPrice = $item->material ? $item->material->price_per_unit : 0;
            $itemTotal = ($item->service->fixed_price + ($materialPrice * $item->quantity)) * $item->quantity;
            $total += $itemTotal;
            $item->calculated_total = $itemTotal; // Сохраняем для вывода в шаблоне
        }

        return view('cart.index', compact('cartItems', 'total'));
    }

    // Добавить в корзину
    public function add(Request $request, Service $service)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:1',
            'material_id' => 'nullable|exists:materials,id',
        ]);

        // Ищем, есть ли уже такая услуга с таким материалом у пользователя
        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('service_id', $service->id)
            ->where('material_id', $request->material_id)
            ->first();

        if ($cartItem) {
            // Если есть, просто увеличиваем количество
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            // Если нет, создаем новую запись
            CartItem::create([
                'user_id' => Auth::id(),
                'service_id' => $service->id,
                'material_id' => $request->material_id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Услуга добавлена в корзину!');
    }

    // Удалить из корзины
    public function remove(CartItem $cartItem)
    {
        // Проверяем, что удаляет владелец
        if ($cartItem->user_id === Auth::id()) {
            $cartItem->delete();
        }
        return redirect()->route('cart.index')->with('success', 'Услуга удалена из корзины');
    }
    // Показать страницу оформления заказа
    public function checkout()
    {
        $cartItems = CartItem::with(['service', 'material'])
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('home')->with('error', 'Ваша корзина пуста.');
        }

        $total = 0;
        foreach ($cartItems as $item) {
            $materialPrice = $item->material ? $item->material->price_per_unit : 0;
            $total += ($item->service->fixed_price + ($materialPrice * $item->quantity)) * $item->quantity;
        }

        return view('cart.checkout', compact('cartItems', 'total'));
    }

    // Обработка формы оформления заказа
    public function processCheckout(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'preferred_date' => 'nullable|date',
            'comment' => 'nullable|string',
        ]);

        $cartItems = CartItem::with(['service', 'material'])
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('home');
        }

        // Считаем итоговую сумму
        $total = 0;
        foreach ($cartItems as $item) {
            $materialPrice = $item->material ? $item->material->price_per_unit : 0;
            $total += ($item->service->fixed_price + ($materialPrice * $item->quantity)) * $item->quantity;
        }

        // 1. Создаем сам заказ
        $order = \App\Models\Order::create([
            'user_id' => Auth::id(),
            'status' => 'new',
            'total' => $total,
            'address' => $request->address,
            'phone' => $request->phone,
            'preferred_date' => $request->preferred_date,
            'comment' => $request->comment,
        ]);

        // 2. Переносим товары из корзины в заказ
        foreach ($cartItems as $item) {
            \App\Models\OrderItem::create([
                'order_id' => $order->id,
                'service_id' => $item->service_id,
                'material_id' => $item->material_id,
                'quantity' => $item->quantity,
                'fixed_price' => $item->service->fixed_price,
                'material_price' => $item->material ? $item->material->price_per_unit : 0,
            ]);
            // Удаляем из корзины
            $item->delete();
        }

        return redirect()->route('cart.success', $order->id)->with('success', 'Заказ успешно оформлен!');
    }

    // Страница "Спасибо за заказ"
    public function success(\App\Models\Order $order)
    {
        // Защита, чтобы пользователь не мог подсмотреть чужие заказы
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }
        return view('cart.success', compact('order'));
    }
}