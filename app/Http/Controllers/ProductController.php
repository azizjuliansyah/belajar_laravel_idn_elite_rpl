<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'photo_product' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:2048']
        ]);

        if ($request->hasFile('photo_product')) {
            $file = $request->file('photo_product');
            $filename = time() . '.' . $file->getClientOriginalExtension(); // 1777867752.jpg
            $file->storeAs('products/photo', $filename, 'public');
            $data['photo_product'] = $filename;
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Berhasil menambahkan data produk');        
    }

    public function update(Request $request, int $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'photo_product' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:2048']
        ]);

        if ($request->hasFile('photo_product')) {
                
            if ($product->photo_product) {
                Storage::disk('public')->delete('storage/products/photo/' . $product->photo_product);
            }
        
            $file = $request->file('photo_product');
            $filename = time() . '.' . $file->getClientOriginalExtension(); // 1777867752.jpg
            $file->storeAs('products/photo', $filename, 'public');
            $data['photo_product'] = $filename;
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Berhasil mengubah data produk');
    }

    public function destroy(int $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Berhasil menghapus data produk');
    }
}