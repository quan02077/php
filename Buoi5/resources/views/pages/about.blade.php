@extends('layouts.app')

@section('title', 'Giới thiệu khóa học')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">

    <x-card title="🎯 Mục tiêu học phần">
        <p>Học phần này trang bị cho sinh viên kiến thức toàn diện về Framework Laravel 12 để xây dựng các ứng dụng web chuẩn công nghiệp...</p>
    </x-card>

    <x-card title="📅 Lịch trình 7 buổi Lab">
        <ul>
            @foreach($labs as $lab)
                <li><strong>Lab 0{{ $loop->iteration }}:</strong> {{ $lab }}</li>
            @endforeach
        </ul>
    </x-card>

</div>
@endsection
