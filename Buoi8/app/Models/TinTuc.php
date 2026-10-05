<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TinTuc extends Model
{
    use SoftDeletes;

    protected $table = 'tin_tucs';

    protected $fillable = [
        'tieude', 'slug', 'tomtat', 'noidung', 'ngaydang', 'trang_thai',
        'danhmuc_id', 'hinhanh', 'hinhanh_path'
    ];

    protected $casts = [
        'ngaydang' => 'date',
    ];

    public function danhMuc()
    {
        return $this->belongsTo(DanhMuc::class, 'danhmuc_id');
    }

    public function getThumbUrlAttribute(): string
    {
        return $this->hinhanh_path
            ? asset('storage/' . $this->hinhanh_path)
            : asset('images/news/' . ($this->hinhanh ?? 'no-image.jpg'));
    }
}
