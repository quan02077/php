@extends('layouts.app')

@section('content')
    <h2>Danh sách sản phẩm</h2>
    
    <table>
        <tr>
            <th>Tên</th>
            <th>Giá</th>
            <th>Stock</th>
            <th>Danh mục</th>
        </tr>
        @foreach($products as $p)
        <tr>
            <td>{{ $p->name }}</td>
            <td>{{ number_format($p->price) }} đ</td>
            <td>{{ $p->stock }}</td>
            <td>{{ $p->category->name }}</td>
            <td>
                <a href="{{ route('products.edit', $p['id']) }}">Sửa</a>
            </td>
        </tr>
        @endforeach
    </table>
    <div>
        <a href="{{ route('products.create') }}">Tao san pham</a>
        {{ $products->links() }}
    </div>
@endsection