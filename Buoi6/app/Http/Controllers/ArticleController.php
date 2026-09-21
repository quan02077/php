<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = [
            ['id' => 1, 'title' => 'Giới thiệu Laravel 12', 'body' => 'Nội dung A'],
            ['id' => 2, 'title' => 'Blade Components', 'body' => 'Nội dung B'],
        ];
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body'  => ['required', 'string', 'min:10'], 
        ]);

        return redirect()->route('articles.index')->with('success', 'Tạo bài viết thành công.');
    }

    /**
     * Display the specified resource.
     */
   public function show(Article $article)
    {
        return "Xem chi tiết bài viết thực thể: ID = {$article->id}, Tiêu đề = {$article->title}";
    } 

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $article = (object) [
            'id'    => $id, 
            'title' => 'Tiêu đề mẫu cho bài viết số ' . $id, 
            'body'  => 'Nội dung mẫu của bài viết này cần dài hơn mười ký tự.'
        ];

        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body'  => ['required', 'string', 'min:10'],
        ]);

        return redirect()->route('articles.index')->with('success', "Cập nhật bài viết #{$id} thành công.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return redirect()->route('articles.index')->with('success', "Đã xóa bài viết #{$id}.");
    }
}
