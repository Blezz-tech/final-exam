<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <title>Авоська - @yield('title')</title>
</head>

<body>
    <nav class="navbar bg-dark pb-4 pt-4" data-bs-theme="dark">
        <div class="container d-flex">
            <a class="navbar-brand" href="{{ route('home') }}">
                @if(auth()->check())
                    @if(auth()->user()->is_admin)    
                        Кабинет администратора
                    @else
                        Личный кабинет
                    @endif
                @else
                    Главная страница
                @endif
            </a>
            {{-- <a class="navbar-brand" href="{{ route('about') }}">О нас</a> --}}
            {{-- <a class="navbar-brand" href="{{ route('catalog') }}">Каталог</a> --}}
            {{-- <a class="navbar-brand" href="{{ route('contacts') }}">Контакты</a> --}}
            {{-- TODO: Ссылки на статичные страницы (Нужно добавть свои - верхние удалить) --}}
            
            @auth
                @if (Auth::user()->is_admin)
                    {{-- <a class="navbar-brand" href="{{route('orders.list')}}" class="nav-link active">Мои заказы</a> --}}
                    {{-- TODO: Ссылки на страницы с какой-то работой АДМИНА (Нужно добавить свои - верхние удалить) --}}
                @else
                    {{-- <a class="navbar-brand" href="{{route('tasks.index')}}">Заявки</a> --}}
                    {{-- <a class="navbar-brand" href="{{route('tasks.create')}}">Создать заявку</a> --}}
                    {{-- <a class="navbar-brand" href="{{route('orders.list')}}" class="nav-link active">Мои заказы</a> --}}
                    {{-- TODO: Ссылки на страницы с какой-то работой ЮЗЕРА (Нужно добавить свои - верхние удалить) --}}
                @endif
            @endauth

            <div class="d-flex" style="width: max-content">
                @guest
                    <a class="btn btn-secondary" href="{{ route('auth.createform') }}">Зарегистрироваться</a>
                    <a class="btn btn-success" href="{{ route('auth.loginform') }}" style="margin-left: 15px">Вход</a>
                @endguest
                @auth
                    <a class="btn btn-secondary" href="{{ route('auth.logout') }}">Выйти</a>|
                @endauth
            </div>
        </div>
    </nav>
    <div class="container p-4">
        @if (session()->has('info'))
            <div class="alert alert-success fade show d-flex justify-content-between">
                <p style="margin: 0">{{ session('info') }}</p>
                <button type="button" class="btn-close" data-bs-dismiss='alert'></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </div>
    <script src="{{ asset('/js/bootstrap.bundle.js') }}"></script>
</body>

</html>
