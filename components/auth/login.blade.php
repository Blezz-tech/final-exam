@extends('layouts.layout')

@section('content')
    <div class='container w-50'>
        <h1>Введите данные</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="post" action="{{ route('auth.login') }}">
            @csrf
            <div class="mb-3">
                <label for="login" class="form-label">Логин</label>
                <input name = "login" type="text" class="form-control" id="login" value="{{ old('login') }}" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Пароль</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-primary">Войти</button>
        </form>
    </div>
@endsection

