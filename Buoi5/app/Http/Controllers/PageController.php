<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about(){
        $labs = [
            'Buổi 1: Giới thiệu Laravel Framework và cài đặt môi trường',
            'Buổi 2: Route cơ bản & gợi nhớ PHP',
            'Buổi 3: Controller & Blade Template Engine',
            'Buổi 4: Model, Migration & Eloquent ORM',
            'Buổi 5: Form xử lý, CSRF & Validation dữ liệu',
            'Buổi 6: Blade directive nâng cao & Component',
            'Buổi 7: Kiểm thử tự động với PHPUnit và tổng kết dự án'
        ];

        return view('pages.about', compact('labs'));
    }
}
