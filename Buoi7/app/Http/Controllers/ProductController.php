<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Student;

class ProductController extends Controller
{
    public function index(){
        $products = Product::with('category')->paginate(10);
        return view('products.index', compact('products'));
    }
    public function create(){
    $categories = Category::all();
    return view('products.create', compact('categories'));
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id'
        ], [
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'price.required' => 'Vui lòng nhập giá',
        ]);

        Product::create($validated);
        return redirect('/products')->with('success', 'Thêm sản phẩm thành công!');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all(); 
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id'
        ]);

        $product->update($validated);
        return redirect('/products')->with('success', 'Cập nhật thành công!');
    }

    public function baiTap08()
    {
        $expensiveProducts = Product::where('price', '>', 100000)->get();

        $categories = Category::withCount('products')->get();

        $students = Student::withCount('courses')->get();

        return view('products.bai_tap_08', compact('expensiveProducts', 'categories', 'students'));
    }
}
