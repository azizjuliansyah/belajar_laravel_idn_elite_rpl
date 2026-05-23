<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product_categories = ProductCategory::all();
        return view('product-categories.index', compact('product_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'description' => ['nullable', 'string', 'min:2'],
        ]);

        ProductCategory::create($data);

        return redirect()->route('product-categories.index')->with('success', 'Berhasil menambahkan data kategori produk');     
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = ProductCategory::findOrFail($id);
        if (Product::find($id, 'product_category_id')) {
            return redirect()->route('product-categories.index')->with('error', 'Gagal menghapus data kategori produk, kategori digunakan oleh data lain');
        }
        
        $product->delete();

        return redirect()->route('product-categories.index')->with('success', 'Berhasil menghapus data kategori produk');
    }
}