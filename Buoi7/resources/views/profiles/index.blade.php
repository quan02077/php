@extends('layouts.app')

@section('title', 'Danh sách User')

@section('content')
    <h2>Danh sách User và Profile (One to One)</h2>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Tên User</th>
            <th>Email</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
        </tr>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->profile->address ?? 'Chưa cập nhật' }}</td>
            <td>{{ $user->profile->phone ?? 'Chưa cập nhật' }}</td>
        </tr>
        @endforeach
    </table>
@endsection