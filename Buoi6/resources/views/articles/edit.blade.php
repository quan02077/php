@extends('layouts.app')
@section('title', 'Sửa bài viết')

@push('styles')
    <style>
        .form-label { display: block; margin: 8px 0 4px; }
        .editor-textarea { width: 100%; padding: 8px; border: 1px solid #e5e7eb; border-radius: 6px; }
        .error-msg { color: #991B1B; margin-top: 4px; }
        .action-group { margin-top: 15px; display: flex; gap: 10px; align-items: center; }
    </style>
@endpush

@section('content')
    <!-- Bài tập 09: Hiển thị breadcrumb (Blade include) -->
    @include('partials.breadcrumb')

    <h2>Sửa bài viết #{{ $article->id }}</h2>
    
    <form action="{{ route('articles.update', $article->id) }}" method="post">
        @csrf
        @method('PUT')
        
        <x-input name="title" label="Tiêu đề" :value="$article->title" />
        
        <label class="form-label">Nội dung</label>
        <textarea name="body" rows="6" class="editor-textarea">{{ old('body', $article->body) }}</textarea>
        
        @error('body')
            <div class="error-msg">{{ $message }}</div>
        @enderror
        
        <div class="action-group">
            <!-- Bài tập 08: Sử dụng anonymous component với biến thể -->
            <x-button variant="primary">Cập nhật</x-button>
            
            <!-- Bài tập 09: Dùng route() thay vì hard-code cho nút quay lại -->
            <a href="{{ route('articles.index') }}">Quay lại danh sách</a>
        </div>
    </form>
@endsection