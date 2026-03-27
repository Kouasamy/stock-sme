@extends('layouts.app')

@section('title', 'Gestion des Fournisseurs')

@section('content')
<div style="display: grid; grid-template-columns: 1fr 2fr; gap: 2rem;">
    <!-- Formulaire d'ajout -->
    <div class="card" style="padding: 1.5rem; height: fit-content;">
        <h3 style="margin-bottom: 1.5rem;">Nouveau Fournisseur</h3>
        <form action="{{ route('suppliers.store') }}" method="POST">
            @csrf
            <div style="margin-bottom: 1rem;">
                <label style="display: block; margin-bottom: 0.5rem; color: var(--text-muted);">Nom</label>
                <input type="text" name="name" required style="width: 100%; padding: 0.75rem; border-radius: 0.5rem; background: var(--glass); border: 1px solid var(--border); color: white;">
            </div>
            <div style="margin-bottom: 1rem;">
                <label style="display: block; margin-bottom: 0.5rem; color: var(--text-muted);">Email</label>
                <input type="email" name="email" required style="width: 100%; padding: 0.75rem; border-radius: 0.5rem; background: var(--glass); border: 1px solid var(--border); color: white;">
            </div>
            <div style="margin-bottom: 1rem;">
                <label style="display: block; margin-bottom: 0.5rem; color: var(--text-muted);">Téléphone</label>
                <input type="text" name="phone" style="width: 100%; padding: 0.75rem; border-radius: 0.5rem; background: var(--glass); border: 1px solid var(--border); color: white;">
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%;">Ajouter</button>
        </form>
    </div>

    <!-- Liste -->
    <div class="card">
        <div class="card-header">
            <h2 style="font-size: 1.25rem;">Tous les Fournisseurs</h2>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($suppliers as $supplier)
                <tr>
                    <td>{{ $supplier->name }}</td>
                    <td>{{ $supplier->email }}</td>
                    <td>{{ $supplier->phone }}</td>
                    <td>
                        <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" onsubmit="return confirm('Supprimer ce fournisseur ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn" style="background: rgba(239, 68, 68, 0.1); color: var(--danger);">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
