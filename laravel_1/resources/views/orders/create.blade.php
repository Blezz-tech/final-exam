@extends('layouts.layout')

@section('content')
<div class="container">
    <h3>Формирование заказа</h3>
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="product_id" class="form-label">Выберите товар:</label>
            <select class="form-select" id="product_id" name="product_id">
                <option value="">Выберите товар</option>
                @foreach ($products as $product)
                    <option
                        value="{{ $product->id }}"
                        @selected(old('product_id') == $product->id)
                    >
                        {{ $product->name }} ({{ $product->price }} руб.)
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Количество:</label>
            <input type="number" class="form-control" id="quantity" name="quantity"></label>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Адрес доставки:</label>
            <input type="text" class="form-control" id="address" name="address"></label>
        </div>
        <button class="btn btn-primary" type="submit">
            Создать
        </button>
    </form>
</div>
@endsection
