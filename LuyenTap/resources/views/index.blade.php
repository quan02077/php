@extends('layouts.app')
@section('content')

<table>
<thead>
<tr><th>STT</th><th>Tên sản phẩm</th><th>Giá</th><th>Số lượng tồn</th><th>Thao tác</th></tr>
</thead>
<tbody>
@foreach($products as $prod)
<tr>
<td>{{ $loop->iteration }}</td>
<td>{{ $prod->name }}</td>
<td>{{ $prod->price }}</td>
<td>{{ $prod->stock }}</td>
<td>
<a href="/products/{{ $prod->id }}/edit">Sửa</a>
<form action="/products/{{ $prod->id }}/delete" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')" style="border: none; background: none; color: blue; text-decoration: underline; cursor: pointer; padding: 0;">Xóa</button>
</form>
</td>
</tr>
@endforeach
</tbody>
</table>

@endsection