@extends('layouts.app')
@section('content')

<div>
    <h1>Sửa sản phẩm</h1>
    <a href="/">Quay lại</a>
    <form method="post" action="/products/{{ $product->id }}">
        @csrf
        @method('PUT')
        <div style="padding: 20px;">
            <div style="padding: 10px;">
                <label for="name">Tên sản phẩm</label><br>
                <input type="text" name="name" placeholder="Nhập tên sản phẩm..." value="{{ $product->name }}" required>
            </div>
        
            <div style="padding: 10px;">
                <label for="price">Giá</label><br>
                <input type="number" name="price" placeholder="Nhập giá..." value="{{ $product->price }}" required>
            </div>
            <div style="padding: 10px;">
                <label for="stock">Số lượng</label><br>
                <input type="number" name="stock" placeholder="Nhập số lượng..." value="{{ $product->stock }}" required>
            </div>
        </div>
        <div style="padding: 20px;">
            <input type="submit" value="Sửa sản phẩm">
        </div>
    </form>
</div>

@endsection