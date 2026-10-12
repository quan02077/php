@extends('layouts.app')

@section('content')

<h3>Sửa trạm</h3>

{{-- lỗi validate --}}
@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $e)
            <div>{{ $e }}</div>
        @endforeach
    </div>
@endif

<form action="{{ route('admin.stations.update', $station->id) }}" method="POST">
    @csrf
    @method('PUT')

    {{-- tên trạm --}}
    <div class="mb-3">
        <label>Tên trạm</label>
        <input type="text"
               name="name"
               class="form-control"
               value="{{ old('name', $station->station_name) }}">
    </div>

    {{-- địa chỉ --}}
    <div class="mb-3">
        <label>Địa chỉ</label>
        <input type="text"
               name="address"
               class="form-control"
               value="{{ old('address', $station->address) }}">
    </div>

    {{-- phường --}}
    <div class="mb-3">
        <label>Phường</label>
        <select name="ward" class="form-control">
            @foreach($wards as $w)
                <option value="{{ $w['name'] }}"
                    {{ old('ward', $station->ward) == $w['name'] ? 'selected' : '' }}>
                    {{ $w['name'] }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- sức chứa --}}
    <div class="mb-3">
        <label>Sức chứa</label>
        <input type="number"
               name="capacity"
               class="form-control"
               value="{{ old('capacity', $station->total_docks) }}">
    </div>

    {{-- trạng thái --}}
    <div class="mb-3">
        <label>Trạng thái</label>
        <select name="status" class="form-control">
            <option value="active"
                {{ old('status', $station->status) == 'active' ? 'selected' : '' }}>
                Đang hoạt động
            </option>

            <option value="inactive"
                {{ old('status', $station->status) == 'inactive' ? 'selected' : '' }}>
                Đang bảo trì
            </option>
        </select>
    </div>

    <button class="btn btn-primary">Cập nhật</button>
    <a href="{{ route('admin.stations.index') }}" class="btn btn-secondary">Quay lại</a>

</form>

@endsection

