@extends('layouts.app')
@section('content')

<div>
    <h1>Thêm sản phẩm</h1>
    <form method="post" action="/products">
        @csrf
        <div style="padding: 20px;">
            <div style="padding: 10px;">
                <label for="name">Tên sản phẩm</label><br>
                <input type="text" name="name" placeholder="Nhập tên sản phẩm..." required>
            </div>
        
            <div style="padding: 10px;">
                <label for="price">Giá</label><br>
                <input type="number" name="price" placeholder="Nhập giá..." required>
            </div>
            <div style="padding: 10px;">
                <label for="stock">Số lượng</label><br>
                <input type="number" name="stock" placeholder="Nhập số lượng..." required>
            </div>
        </div>
        <div style="padding: 20px;">
            <input type="submit" value="Thêm sản phẩm">
        </div>
    </form>
</div>

@endsection