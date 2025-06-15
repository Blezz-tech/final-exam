@extends('layouts.layout')

@section('title')
    @if(auth()->check())
        @if(auth()->user()->is_admin)    
            Кабинет администратора
        @else
            Личный кабинет
        @endif
    @else
        Главная страница
    @endif
@endsection

@section('content')

@endsection
