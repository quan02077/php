@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h3>Quản lý trạm xe</h3>

    <div>
        <a href="{{ route('admin.stations.create') }}" class="btn btn-primary">Thêm trạm mới</a>
        <a href="{{ route('admin.stations.trash') }}" class="btn btn-danger">Thùng rác</a>
    </div>
</div>

<table class="table table-bordered text-center">
    <thead class="table-dark">
        <tr>
            <th>Tên trạm</th>
            <th>Địa chỉ</th>
            <th>Số chỗ trống</th>
            <th>Số xe</th>
            <th>Đánh giá</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($stations as $station)
        <tr>
            <td>{{ $station->station_name }}</td>
            <td>
                {{ $station->address }}<br>
                <small>{{ $station->ward }}</small>
            </td>
            <td>{{ $station->total_docks - $station->bike_count }} / {{ $station->total_docks }}</td>
            <td>{{ $station->bike_count ?? 0 }}</td>
            <td>
                &#9733; {{ number_format($station->avg_rating, 1) }}
                <br>
                <small>({{ $station->total_reviews ?? 0 }} đánh giá)</small>
            </td>
            <td>
                <span class="badge bg-{{ $station->status == 'active' ? 'success' : 'secondary' }}">
                    {{ $station->status == 'active' ? 'Đang hoạt động' : 'Đang bảo trì' }}
                </span>
            </td>
            <td>
                <a href="{{ route('admin.stations.edit', $station->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                <form action="{{ route('admin.stations.destroy', $station->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Phân trang -->
<div class="d-flex justify-content-center">
    {{ $stations->links() }}
</div>

@endsection

