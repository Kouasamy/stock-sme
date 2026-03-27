@extends('layouts.app')

@section('title', 'Modifier le Produit')

@section('content')
<div class="card" style="max-width: 800px; margin: 0 auto; padding: 2rem;">
    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; color: var(--text-muted);">Nom du produit</label>
                <input type="text" name="name" value="{{ $product->name }}" required style="width: 100%; padding: 0.75rem; border-radius: 0.5rem; background: var(--glass); border: 1px solid var(--border); color: white;">
            </div>
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; color: var(--text-muted);">SKU (Code unique)</label>
                <input type="text" name="sku" value="{{ $product->sku }}" required style="width: 100%; padding: 0.75rem; border-radius: 0.5rem; background: var(--glass); border: 1px solid var(--border); color: white;">
            </div>
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; margin-bottom: 0.5rem; color: var(--text-muted);">Description</label>
            <textarea name="description" rows="3" style="width: 100%; padding: 0.75rem; border-radius: 0.5rem; background: var(--glass); border: 1px solid var(--border); color: white;">{{ $product->description }}</textarea>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; color: var(--text-muted);">Prix (FCFA)</label>
                <input type="number" name="price" value="{{ $product->price }}" required style="width: 100%; padding: 0.75rem; border-radius: 0.5rem; background: var(--glass); border: 1px solid var(--border); color: white;">
            </div>
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; color: var(--text-muted);">Seuil d'alerte (Stock Bas)</label>
                <input type="number" name="low_stock_threshold" value="{{ $product->low_stock_threshold }}" required style="width: 100%; padding: 0.75rem; border-radius: 0.5rem; background: var(--glass); border: 1px solid var(--border); color: white;">
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; color: var(--text-muted);">Catégorie</label>
                <select name="category_id" required style="width: 100%; padding: 0.75rem; border-radius: 0.5rem; background: var(--glass); border: 1px solid var(--border); color: white;">
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; color: var(--text-muted);">Fournisseur</label>
                <select name="supplier_id" required style="width: 100%; padding: 0.75rem; border-radius: 0.5rem; background: var(--glass); border: 1px solid var(--border); color: white;">
                    @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ $product->supplier_id == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div style="margin-top: 2rem; display: flex; gap: 1rem; justify-content: flex-end;">
            <a href="{{ route('products.index') }}" class="btn" style="background: var(--glass); color: white;">Annuler</a>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </div>
    </form>
</div>
@endsection
