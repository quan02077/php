@extends('layouts.app')

@section('content')

<h3>Thêm trạm</h3>

@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $e)
            <div>{{ $e }}</div>
        @endforeach
    </div>
@endif

<form action="{{ route('admin.stations.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Tên trạm</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
    </div>

    <div class="mb-3">
        <label>Địa chỉ</label>
        <input type="text" name="address" class="form-control" value="{{ old('address') }}">
    </div>

    <div class="mb-3">
        <label>Phường</label>
        <select name="ward" class="form-control">
            @foreach($wards as $w)
                <option value="{{ $w['name'] }}" {{ old('ward') == $w['name'] ? 'selected' : '' }}>
                    {{ $w['name'] }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Sức chứa</label>
        <input type="number" name="capacity" class="form-control" value="{{ old('capacity') }}">
    </div>

    <button class="btn btn-primary">Lưu</button>
</form>

@endsection

