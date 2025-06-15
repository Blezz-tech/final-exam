@extends('layouts.layout')

@section('content')
    <div class='container w-50'>
        <h1>Введите данные регистрации</h1>
        <form method="post" action="{{ route('auth.store') }}">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">ФИО</label>
              <input name="name" type="string" class="form-control" id="name" aria-describedby="name">
            </div>
            <div class="mb-3">
              <label for="login" class="form-label">Логин</label>
              <input name="login" type="string" class="form-control" id="login" aria-describedby="login">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input name="email" type="email" class="form-control" id="email" aria-describedby="email">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Пароль</label>
              <input name="password" type="password" class="form-control" id="password">
            </div>
            <div class="mb-3">
              <label for="password_confirmation" class="form-label">Повторите пароль</label>
              <input name="password_confirmation" type="password" class="form-control" id="password_confirmation">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Телефон</label>
                <input type="text" class="form-control" id="phone" name="phone">
            </div>
            <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
        </form>
    </div>
@endsection
