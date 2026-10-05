@extends('admin.layouts.main')
@section('title', 'Thêm bài viết')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tổng quan</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.tin.index') }}">Tin tức</a></li>
    <li class="breadcrumb-item active">Thêm bài viết</li>
@endsection

@section('content')
<h1 class="h4 mb-3">Thêm bài viết mới</h1>

<form class="card card-body" method="post" action="{{ route('admin.tin.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row g-3">
        <div class="col-lg-8">
            <div class="mb-3">
                <label class="form-label fw-semibold">Tiêu đề <span class="text-danger">*</span></label>
                <input name="tieude" value="{{ old('tieude') }}" class="form-control" placeholder="Nhập tiêu đề bài viết" required>
                @error('tieude')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Slug (đường dẫn thân thiện)</label>
                <input name="slug" value="{{ old('slug') }}" class="form-control" placeholder="Để trống hệ thống sẽ tự động phát sinh từ tiêu đề">
                @error('slug')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Tóm tắt</label>
                <textarea name="tomtat" rows="2" class="form-control" placeholder="Tóm tắt ngắn gọn...">{{ old('tomtat') }}</textarea>
                @error('tomtat')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Nội dung <span class="text-danger">*</span></label>
                <textarea name="noidung" rows="8" class="form-control" placeholder="Nội dung chi tiết bài viết..." required>{{ old('noidung') }}</textarea>
                @error('noidung')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label fw-semibold">Danh mục</label>
                <select name="danhmuc_id" class="form-select">
                    <option value="">-- Không chọn --</option>
                    @foreach($dm as $c)
                        <option value="{{ $c->id }}" @selected(old('danhmuc_id') == $c->id)>{{ $c->ten }}</option>
                    @endforeach
                </select>
                @error('danhmuc_id')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Trạng thái xuất bản</label>
                <div class="d-flex gap-3 mt-1">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="trang_thai" id="st_draft" value="draft" {{ old('trang_thai', 'draft') == 'draft' ? 'checked' : '' }}>
                        <label class="form-check-label" for="st_draft">Nháp</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="trang_thai" id="st_published" value="published" {{ old('trang_thai') == 'published' ? 'checked' : '' }}>
                        <label class="form-check-label text-success fw-semibold" for="st_published">Đã đăng</label>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Ngày đăng</label>
                <input type="date" name="ngaydang" value="{{ old('ngaydang', now()->toDateString()) }}" class="form-control">
                @error('ngaydang')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Ảnh đại diện</label>
                <input type="file" name="hinhanh_up" class="form-control" accept="image/*" onchange="previewImg(this)">
                <div class="form-text">Hỗ trợ jpg, jpeg, png, webp ≤ 2MB</div>
                @error('hinhanh_up')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror

                <div class="mt-2 text-center d-none" id="preview_box">
                    <img id="preview_img" src="#" alt="Preview" class="img-thumbnail" style="max-height: 140px;">
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3 d-flex gap-2">
        <button class="btn btn-primary px-4">Lưu bài viết</button>
        <a class="btn btn-secondary" href="{{ route('admin.tin.index') }}">Hủy</a>
    </div>
</form>
@endsection

@push('scripts')
<script>
function previewImg(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview_img').src = e.target.result;
            document.getElementById('preview_box').classList.remove('d-none');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
