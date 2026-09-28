@extends('layouts.app')

@section('content')
    <!-- Yêu cầu 1 -->
    <h2>1. Sản phẩm có giá > 100,000 đ</h2>
    <table>
        <tr>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
        </tr>
        @foreach($expensiveProducts as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ number_format($product->price) }} đ</td>
        </tr>
        @endforeach
    </table>

    <!-- Yêu cầu 2 -->
    <h2 style="margin-top: 30px;">2. Số lượng sản phẩm mỗi danh mục</h2>
    <table>
        <tr>
            <th>Tên Danh mục</th>
            <th>Số lượng Sản phẩm</th>
        </tr>
        @foreach($categories as $category)
        <tr>
            <td>{{ $category->name }}</td>
            <!-- Khi dùng withCount('products'), Laravel tự sinh ra cột products_count -->
            <td>{{ $category->products_count }} sản phẩm</td>
        </tr>
        @endforeach
    </table>

    <!-- Yêu cầu 3 -->
    <h2 style="margin-top: 30px;">3. Sinh viên và số môn học đã đăng ký</h2>
    <table>
        <tr>
            <th>Tên Sinh viên</th>
            <th>Số môn học (Courses)</th>
        </tr>
        @foreach($students as $student)
        <tr>
            <td>{{ $student->name }}</td>
            <!-- Tương tự, withCount('courses') sẽ sinh ra cột courses_count -->
            <td>{{ $student->courses_count }} môn</td>
        </tr>
        @endforeach
    </table>
@endsection