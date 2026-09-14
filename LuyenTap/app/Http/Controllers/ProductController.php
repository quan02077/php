<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('index', compact('products'));
    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
        ]);

        Product::create($validated);
        return redirect('/');
    }

    public function edit(int $id){
        $product = Product::find($id);
        return view('products.edit', compact('product'));
    }
    
    public function update(Request $request, int $id){
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
        ]);

        $product = Product::find($id);
        $product->update($validated);
        return redirect('/');
    }

    public function delete(int $id){
        $product = Product::find($id);
        $product->delete();
        return redirect('/');
    }
}
