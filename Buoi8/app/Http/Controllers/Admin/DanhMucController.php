<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DanhMuc;
use Illuminate\Http\Request;
use App\Http\Requests\DanhMucRequest;
use Illuminate\Support\Str;

class DanhMucController extends Controller
{
    public function index(Request $request)
    {
        $q = DanhMuc::query();
        if ($kw = trim($request->get('kw', ''))) {
            $q->where(function ($x) use ($kw) {
                $x->where('ten', 'like', "%{$kw}%")
                    ->orWhere('slug', 'like', "%{$kw}%");
            });
        }
        /** @var \Illuminate\Pagination\LengthAwarePaginator $rows */
        $rows = $q->latest('id')->paginate(10);
        $rows->withQueryString();
        return view('admin.danh_muc.index', compact('rows', 'kw'));
    }
    public function create()
    {
        return view('admin.danh_muc.create');
    }
    public function store(DanhMucRequest $request)
    {
        $data = $request->validated();
        if (blank($data['slug'])) $data['slug'] = Str::slug($data['ten']);
        DanhMuc::create($data);
        return redirect()->route('admin.danhmuc.index')->with('ok', 'Thêm danh mục thành công');
    }
    public function show(DanhMuc $danhMuc)
    {
        //
    }
    public function edit(DanhMuc $danhmuc)
    {
        return view('admin.danh_muc.edit', compact('danhmuc'));
    }
    public function update(DanhMucRequest $request, DanhMuc $danhmuc)
    {
        $data = $request->validated();
        if (blank($data['slug'])) $data['slug'] = Str::slug($data['ten']);
        $danhmuc->update($data);
        return redirect()->route('admin.danhmuc.index')->with('ok', 'Cập nhật danh mục thành công');
    }
    public function destroy(DanhMuc $danhmuc)
    {
        $danhmuc->delete();
        return back()->with('ok', 'Đã xóa danh mục');
    }
}
