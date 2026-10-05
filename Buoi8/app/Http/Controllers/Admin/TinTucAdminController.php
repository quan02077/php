<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TinTucRequest;
use App\Models\TinTuc;
use App\Models\DanhMuc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TinTucAdminController extends Controller
{
    private function makeUniqueSlug(string $base, ?int $ignoreId = null): string
    {
        $slug = Str::slug($base) ?: Str::random(8);
        $original = $slug;
        $i = 2;
        while (
            TinTuc::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id', '<>', $ignoreId))
                ->exists()
        ) {
            $slug = "{$original}-{$i}";
            $i++;
        }
        return $slug;
    }

    public function index(Request $request)
    {
        $q = TinTuc::query()->with('danhMuc');

        // Tìm kiếm theo từ khóa (Bài 3 & Bài 7)
        $q->when($request->filled('kw'), function ($x) use ($request) {
            $kw = trim($request->kw);
            $x->where(function ($sub) use ($kw) {
                $sub->where('tieude', 'like', "%{$kw}%")
                    ->orWhere('slug', 'like', "%{$kw}%");
            });
        });

        // Lọc nâng cao (Bài 7)
        $q->when($request->filled('danhmuc_id'), fn($x) => $x->where('danhmuc_id', $request->danhmuc_id))
          ->when($request->filled('trang_thai'), fn($x) => $x->where('trang_thai', $request->trang_thai))
          ->when($request->filled('from'), fn($x) => $x->whereDate('ngaydang', '>=', $request->from))
          ->when($request->filled('to'), fn($x) => $x->whereDate('ngaydang', '<=', $request->to));

        // Thùng rác
        if ($request->boolean('trash')) {
            $q->onlyTrashed();
        }

        /** @var \Illuminate\Pagination\LengthAwarePaginator $rows */
        $rows = $q->orderByDesc('id')->paginate(10);
        $rows->withQueryString();
        $dm = DanhMuc::orderBy('ten')->get();

        return view('admin.tin.index', compact('rows', 'dm'));
    }

    public function create()
    {
        $dm = DanhMuc::orderBy('ten')->get();
        return view('admin.tin.create', compact('dm'));
    }

    public function store(TinTucRequest $request)
    {
        $data = $request->validated();

        // Tự sinh slug (Bài 6)
        if (blank($data['slug'] ?? null)) {
            $data['slug'] = $this->makeUniqueSlug($data['tieude']);
        } else {
            $data['slug'] = $this->makeUniqueSlug($data['slug']);
        }

        // Xử lý trạng thái & ngày đăng (Bài 5)
        $data['trang_thai'] = $data['trang_thai'] ?? 'draft';
        if ($data['trang_thai'] === 'published' && empty($data['ngaydang'])) {
            $data['ngaydang'] = now()->toDateString();
        } elseif (empty($data['ngaydang'])) {
            $data['ngaydang'] = now()->toDateString();
        }

        // Upload ảnh nếu có (Bài 3)
        if ($request->hasFile('hinhanh_up')) {
            $data['hinhanh_path'] = $request->file('hinhanh_up')->store('news', 'public');
        }

        TinTuc::create($data);
        return redirect()->route('admin.tin.index')->with('ok', 'Đã thêm bài viết thành công');
    }

    public function show($id)
    {
        //
    }

    public function edit(TinTuc $tin)
    {
        $dm = DanhMuc::orderBy('ten')->get();
        return view('admin.tin.edit', compact('tin', 'dm'));
    }

    public function update(TinTucRequest $request, TinTuc $tin)
    {
        $data = $request->validated();

        // Xử lý slug khi sửa (Bài 6)
        $base = !blank($data['slug'] ?? null) ? $data['slug'] : $data['tieude'];
        $data['slug'] = $this->makeUniqueSlug($base, $tin->id);

        // Chuyển draft -> published cập nhật ngaydang (Bài 5)
        if (($data['trang_thai'] ?? '') === 'published' && empty($tin->ngaydang) && empty($data['ngaydang'])) {
            $data['ngaydang'] = now()->toDateString();
        }

        // Cập nhật ảnh đại diện mới
        if ($request->hasFile('hinhanh_up')) {
            if ($tin->hinhanh_path) {
                Storage::disk('public')->delete($tin->hinhanh_path);
            }
            $data['hinhanh_path'] = $request->file('hinhanh_up')->store('news', 'public');
        }

        $tin->update($data);
        return redirect()->route('admin.tin.index')->with('ok', 'Đã cập nhật bài viết thành công');
    }

    public function destroy(TinTuc $tin)
    {
        $tin->delete(); // Soft delete
        return back()->with('ok', 'Đã đưa bài viết vào thùng rác');
    }

    public function restore($id)
    {
        $tin = TinTuc::withTrashed()->findOrFail($id);
        $tin->restore();
        return back()->with('ok', 'Đã khôi phục bài viết');
    }

    public function forceDelete($id)
    {
        $tin = TinTuc::withTrashed()->findOrFail($id);
        if ($tin->hinhanh_path) {
            Storage::disk('public')->delete($tin->hinhanh_path);
        }
        $tin->forceDelete();
        return back()->with('ok', 'Đã xóa vĩnh viễn bài viết');
    }
}
