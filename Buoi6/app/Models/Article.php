<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function resolveRouteBinding($value, $field = null)
    {
        $mockData = [
            1 => ['id' => 1, 'title' => 'Giới thiệu Laravel 12', 'body' => 'Nội dung bài viết số 1'],
            2 => ['id' => 2, 'title' => 'Blade Components cơ bản', 'body' => 'Nội dung bài viết số 2'],
        ];

        if (array_key_exists($value, $mockData)) {
            $article = new self();
            $article->forceFill($mockData[$value]); 
            $article->exists = true;               

            return $article;
        }

        abort(404, 'Không tìm thấy bài viết!');
    }
}
