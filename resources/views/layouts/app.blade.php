<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>СтройМаркет - Услуги по ремонту</title>
    <!-- Подключаем Bootstrap для быстрой верстки (стили) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Хедер -->
    <header class="bg-dark text-white py-3 mb-4">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0"><a href="{{ route('home') }}" class="text-white text-decoration-none">СтройМаркет</a></h1>
            <div>
                <div class="d-flex align-items-center">
    @guest
        <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Вход</a>
        <a href="{{ route('register') }}" class="btn btn-warning">Регистрация</a>
    @else
<a href="{{ route('cart.index') }}" class="btn btn-outline-light me-3">Корзина</a>
        <div class="dropdown">
            <button class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->name }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Выйти
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    @endguest
</div>
            </div>
        </div>
    </header>

    <!-- Основной контент страницы -->
    <main class="container flex-grow-1">
        @yield('content')
    </main>

    <!-- Футер -->
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <div class="container">
            <p class="mb-0">&copy; 2026 СтройМаркет. Все права защищены.</p>
            <p class="mb-0">Поддержка: support@stroymarket.local</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>