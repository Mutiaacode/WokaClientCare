<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        return view('admin.product.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|max:255',
            'deskripsi' => 'nullable|string',
            'harga_default' => 'nullable|numeric|min:0',
        ]);

        Product::create($validated);

        return redirect()->route('admin.product.index')->with('sukses', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        return view('admin.product.edit', [
            'product' => Product::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'nama_produk' => 'required|max:255',
            'deskripsi' => 'nullable|string',
            'harga_default' => 'nullable|numeric|min:0',
        ]);

        $product->update($validated);

        return redirect()->route('admin.product.index')->with('sukses', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Product::destroy($id);

        return redirect()->route('admin.product.index')->with('sukses', 'Produk berhasil dihapus!');
    }
}
