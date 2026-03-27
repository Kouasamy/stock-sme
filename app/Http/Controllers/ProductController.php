<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Auth::user()->products()->with(['category', 'supplier'])->latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create(Request $request)
    {
        $categories = Auth::user()->categories()->get();
        $suppliers = Auth::user()->suppliers()->get();
        $suggested = [
            'name' => $request->query('name'),
            'sku' => $request->query('sku'),
        ];
        return view('products.create', compact('categories', 'suppliers', 'suggested'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'low_stock_threshold' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        Auth::user()->products()->create($validated);

        return redirect()->route('products.index')->with('success', 'Produit créé avec succès !');
    }

    public function edit(Product $product)
    {
        if ($product->user_id !== Auth::id()) abort(403);
        
        $categories = Auth::user()->categories()->get();
        $suppliers = Auth::user()->suppliers()->get();
        return view('products.edit', compact('product', 'categories', 'suppliers'));
    }

    public function update(Request $request, Product $product)
    {
        if ($product->user_id !== Auth::id()) abort(403);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku,' . $product->id,
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'low_stock_threshold' => 'required|integer|min:0',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Produit mis à jour !');
    }

    public function destroy(Product $product)
    {
        if ($product->user_id !== Auth::id()) abort(403);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produit supprimé !');
    }
}
