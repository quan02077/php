@extends('layouts.app')

@section('title', 'Thêm sinh viên mới')

@section('content')
<div style="max-width: 500px; margin: 20px auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
    <h2>Thêm sinh viên mới</h2>

    <form method="POST" action="{{ url('/students') }}">
        @csrf 

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Họ tên:</label>
            <input type="text" name="name" value="{{ old('name') }}" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            @error('name')
                <small style="color: red; display: block; margin-top: 5px;">{{ $message }}</small>
            @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Email:</label>
            <input type="text" name="email" value="{{ old('email') }}" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            @error('email')
                <small style="color: red; display: block; margin-top: 5px;">{{ $message }}</small>
            @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Lớp học:</label>
            <input type="text" name="class_name" value="{{ old('class_name') }}" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            @error('class_name')
                <small style="color: red; display: block; margin-top: 5px;">{{ $message }}</small>
            @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Tuổi:</label>
            <input type="text" name="age" value="{{ old('age') }}" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            @error('age')
                <small style="color: red; display: block; margin-top: 5px;">{{ $message }}</small>
            @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Giới tính:</label>
            <select name="gender" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                <option value="">-- Chọn giới tính --</option>
                <option value="male" @selected(old('gender') === 'male')>Nam</option>
                <option value="female" @selected(old('gender') === 'female')>Nữ</option>
            </select>
            @error('gender')
                <small style="color: red; display: block; margin-top: 5px;">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" style="background: #10b981; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer; font-weight: bold;">Lưu lại</button>
        <a href="{{ url('/students/db') }}" style="margin-left: 10px; color: #666; text-decoration: none;">Hủy</a>
    </form>
</div>
@endsection
