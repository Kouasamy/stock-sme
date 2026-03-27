<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Auth::user()->categories()->withCount('products')->get();
        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Auth::user()->categories()->create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
        ]);

        return redirect()->route('categories.index')->with('success', 'Catégorie ajoutée !');
    }

    public function destroy(Category $category)
    {
        if ($category->user_id !== Auth::id()) abort(403);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Catégorie supprimée !');
    }
}
