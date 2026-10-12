@extends('layouts.app')

@section('content')

<h3>Thùng rác</h3>

<div class="mb-3">
    <a href="{{ route('admin.stations.index') }}" class="btn btn-secondary">&larr; Quay lại</a>

    <button type="button" id="btnRestoreSelected" class="btn btn-success">
        Khôi phục đã chọn
    </button>

    <button type="button" id="btnDeleteSelected" class="btn btn-danger">
        Xóa đã chọn
    </button>

    <form action="{{ route('admin.stations.restoreAll') }}" method="POST" class="d-inline">
        @csrf
        <button class="btn btn-success"
                onclick="return confirm('Khôi phục tất cả?')">
            Khôi phục tất cả
        </button>
    </form>

    <form action="{{ route('admin.stations.forceDeleteAll') }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger"
                onclick="return confirm('Xóa vĩnh viễn tất cả hợp lệ?')">
            Xóa tất cả
        </button>
    </form>
</div>

<table class="table table-bordered text-center align-middle">
    <thead class="table-dark">
        <tr>
            <th>
                <input type="checkbox" id="checkAll">
            </th>
            <th>Tên trạm</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
    </thead>

    <tbody>
        @forelse($stations as $station)
        <tr>
            <td>
                <input type="checkbox" class="checkItem" value="{{ $station->id }}">
            </td>

            <td>{{ $station->station_name }}</td>

            <td>
                <span class="badge bg-{{ $station->status == 'active' ? 'success' : 'secondary' }}">
                    {{ $station->status == 'active' ? 'Đang hoạt động' : 'Đang bảo trì' }}
                </span>
            </td>

            <td>
                {{-- restore --}}
                <a href="{{ route('admin.stations.restore', $station->id) }}"
                   class="btn btn-success btn-sm">
                    Khôi phục
                </a>

                {{-- force delete --}}
                @if($station->rentalsFrom_count == 0 && $station->rentalsTo_count == 0 && $station->bicycles_count == 0)
                    <form action="{{ route('admin.stations.forceDelete', $station->id) }}"
                          method="POST"
                          class="d-inline">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Xóa vĩnh viễn?')">
                            Xóa cứng
                        </button>
                    </form>
                @else
                    <button class="btn btn-secondary btn-sm" disabled>
                        Không thể xóa
                    </button>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4">Thùng rác trống</td>
        </tr>
        @endforelse
    </tbody>
</table>

<form id="bulkActionForm" method="POST" style="display:none;">
    @csrf
    <input type="hidden" name="ids" id="idsInput">
</form>

<!-- Phân trang -->
<div class="d-flex justify-content-center">
    {{ $stations->links() }}
</div>

<script>
// Nhấn nút checkAll
document.getElementById('checkAll').addEventListener('click', function() {
    let items = document.querySelectorAll('.checkItem');
    items.forEach(i => i.checked = this.checked);
});

// Lấy id các button đã chọn
function getSelectedIds() {
    let ids = [];
    document.querySelectorAll('.checkItem:checked')
        .forEach(i => ids.push(i.value));
    return ids;
}

// restore các trạm đã chọn
document.getElementById('btnRestoreSelected').onclick = function() {
    let ids = getSelectedIds();
    if (ids.length === 0) return alert('Chưa chọn trạm');

    let form = document.getElementById('bulkActionForm');
    document.getElementById('idsInput').value = ids;

    form.action = "{{ route('admin.stations.restoreSelected') }}";
    form.submit();
};

// delete các trạm đã chọn
document.getElementById('btnDeleteSelected').onclick = function() {
    if (!confirm('Xóa các trạm đã chọn?')) return;

    let ids = getSelectedIds();
    if (ids.length === 0) return alert('Chưa chọn trạm');

    let form = document.getElementById('bulkActionForm');
    document.getElementById('idsInput').value = ids;

    form.action = "{{ route('admin.stations.forceDeleteSelected') }}";

    let method = document.createElement('input');
    method.type = 'hidden';
    method.name = '_method';
    method.value = 'DELETE';
    form.appendChild(method);

    form.submit();
};
</script>

@endsection

