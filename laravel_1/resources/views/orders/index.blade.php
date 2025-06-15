@extends('layouts.layout')

@section('content')
<div class="container">
    <h3>Заказы</h3>
    <a href="{{route('orders.create')}}" class="btn btn-primary">Сформировать новый заказ</a>
    @if ($orders->isEmpty())
        <p>У вас пока нет заказов</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID заказа</th>
                    <th>Статус</th>
                    <th>Дата создания</th>
                    <th>Товары</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->status}}</td>
                        <td>{{$order->created_at->format('d.m.Y')}}</td>
                        <td>
                            @foreach ($order->orderItems as $item)
                                {{$item->product->name}} ({{$item->quantity}})<br>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
