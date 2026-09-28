@extends('layouts.app')

@section('content')
    <h2>Thêm sản phẩm mới</h2>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <x-input name="name" label="Tên sản phẩm" />
        <x-input name="price" label="Giá (VNĐ)" />
        
        <div style="margin-bottom: 15px;">
            <label>Danh mục</label>
            <select name="category_id">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" style="padding: 8px 16px; background: #111827; color: white; border: none; cursor: pointer;">Lưu sản phẩm</button>
    </form>
@endsection