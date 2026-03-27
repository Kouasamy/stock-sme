<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Auth::user()->suppliers()->get();
        return view('suppliers.index', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        Auth::user()->suppliers()->create($validated);

        return redirect()->route('suppliers.index')->with('success', 'Fournisseur ajouté !');
    }

    public function destroy(Supplier $supplier)
    {
        if ($supplier->user_id !== Auth::id()) abort(403);
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success', 'Fournisseur supprimé !');
    }
}
