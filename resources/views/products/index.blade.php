@extends('layouts.app')

@section('title', 'Gestion des Produits')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 style="font-size: 1.25rem;">Liste des Produits</h2>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Nouveau Produit</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>SKU</th>
                <th>Nom</th>
                <th>Catégorie</th>
                <th>Stock</th>
                <th>Prix</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td><code style="background: var(--glass); padding: 0.2rem 0.5rem; border-radius: 0.25rem;">{{ $product->sku }}</code></td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td>
                    <span class="badge {{ $product->stock_quantity <= $product->low_stock_threshold ? 'badge-danger' : 'badge-success' }}">
                        {{ $product->stock_quantity }}
                    </span>
                </td>
                <td>{{ number_format($product->price, 0, ',', ' ') }} FCFA</td>
                <td>
                    <div style="display: flex; gap: 0.5rem;">
                        <a href="{{ route('products.edit', $product) }}" class="btn" style="background: var(--glass); color: white;">Éditer</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Supprimer ce produit ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn" style="background: rgba(239, 68, 68, 0.1); color: var(--danger);">Suppr.</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div style="padding: 1.5rem;">
        {{ $products->links() }}
    </div>
</div>
@endsection
