@extends('layouts.app')

@section('content')
    <h2>Sửa sản phẩm: {{ $product->name }}</h2>
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

<x-input name="name" label="Tên sản phẩm" :value="$product->name" />

<x-input name="price" label="Giá" type="number" :value="$product->price" />
        
        <div style="margin-bottom: 15px;">
            <label>Danh mục</label>
            <select name="category_id">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" style="padding: 8px 16px; background: #111827; color: white; border: none; cursor: pointer;">Cập nhật</button>
    </form>
@endsection