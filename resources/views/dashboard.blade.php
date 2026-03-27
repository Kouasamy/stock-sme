@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
@if(session('success'))
    <div style="background: rgba(16, 185, 129, 0.1); color: var(--success); padding: 1rem; border-radius: 0.5rem; margin-bottom: 2rem; border: 1px solid var(--success);">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="background: rgba(239, 68, 68, 0.1); color: var(--danger); padding: 1rem; border-radius: 0.5rem; margin-bottom: 2rem; border: 1px solid var(--danger);">
        {{ session('error') }}
    </div>
@endif

<div class="stats-grid">
    <div class="stat-card" style="position: relative; overflow: hidden; border: 1px solid var(--primary);">
        <div style="position: relative; z-index: 2;">
            <div class="stat-label">Stock Intelligence</div>
            <form action="{{ route('dashboard.advice') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary" style="margin-top: 0.5rem; padding: 0.5rem 1rem; font-size: 0.75rem;">
                    PLUS DE CONSEILS ?
                </button>
            </form>
        </div>
        <div style="position: absolute; right: -10px; bottom: -10px; font-size: 4rem; opacity: 0.1;">💡</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Produits Totaux</div>
        <div class="stat-value">{{ $stats['total_products'] }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Alertes Stock Bas</div>
        <div class="stat-value" style="color: var(--danger)">{{ $stats['low_stock_count'] }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Catégories</div>
        <div class="stat-value">{{ $stats['total_categories'] }}</div>
    </div>
</div>

@if($stats['total_products'] == 0)
<div class="card" style="padding: 3rem; text-align: center; margin-bottom: 2.5rem; background: linear-gradient(135deg, var(--card-bg), rgba(99, 102, 241, 0.1));">
    <h2 style="margin-bottom: 1rem;">Bienvenue sur votre Dashboard !</h2>
    <p style="color: var(--text-muted); margin-bottom: 2rem;">Commencez par ajouter votre premier produit ou choisissez parmi nos suggestions ci-dessous.</p>
    <div style="display: flex; gap: 1rem; justify-content: center;">
        <a href="{{ route('products.create') }}" class="btn btn-primary" style="padding: 1rem 2rem;">Ajouter mon premier Produit</a>
        <a href="{{ route('categories.index') }}" class="btn" style="background: var(--glass); color: white; padding: 1rem 2rem;">Gérer les Catégories</a>
    </div>
</div>

<div style="margin-bottom: 2.5rem;">
    <h3 style="margin-bottom: 1.5rem;">Suggestions d'articles pour votre PME</h3>
    <div class="stats-grid">
        @foreach($stats['suggested_products'] as $suggested)
        <div class="stat-card" style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-weight: 600;">{{ $suggested['name'] }}</div>
                <div style="font-size: 0.75rem; color: var(--text-muted);">{{ $suggested['cat'] }}</div>
            </div>
            <a href="{{ route('products.create', ['name' => $suggested['name'], 'sku' => $suggested['sku']]) }}" class="btn" style="background: var(--glass); color: white; padding: 0.25rem 0.5rem; font-size: 0.75rem;">Sélectionner</a>
        </div>
        @endforeach
    </div>
</div>
@endif

<div class="card" style="margin-bottom: 2.5rem;">
    <div class="card-header">
        <h2 style="font-size: 1.25rem;">Mouvements Récents</h2>
        <a href="{{ route('products.index') }}" class="btn btn-primary" style="font-size: 0.875rem;">Voir tout l'inventaire</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Type</th>
                <th>Quantité</th>
                <th>Date</th>
                <th>Propriétaire</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stats['recent_movements'] as $movement)
            <tr>
                <td>{{ $movement->product->name }}</td>
                <td>
                    <span class="badge {{ $movement->type === 'in' ? 'badge-success' : ($movement->type === 'out' ? 'badge-danger' : 'badge-warning') }}">
                        {{ strtoupper($movement->type) }}
                    </span>
                </td>
                <td>{{ $movement->quantity }}</td>
                <td>{{ $movement->created_at->diffForHumans() }}</td>
                <td>{{ $movement->product->user->name ?? 'Moi' }}</td>
            </tr>
            @endforeach
            @if($stats['recent_movements']->isEmpty())
            <tr>
                <td colspan="5" style="text-align: center; color: var(--text-muted);">Aucun mouvement récent</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>

<div class="card" style="border: 1px solid rgba(239, 68, 68, 0.3); background: rgba(239, 68, 68, 0.05);">
    <div class="card-header" style="border-bottom-color: rgba(239, 68, 68, 0.2);">
        <h2 style="font-size: 1.25rem; color: var(--danger);">Zone de Danger</h2>
    </div>
    <div style="padding: 1.5rem; display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
        <div>
            <h4 style="margin-bottom: 0.5rem;">Réinitialiser l'inventaire</h4>
            <p style="font-size: 0.875rem; color: var(--text-muted); margin-bottom: 1rem;">Supprime tous vos produits, catégories et fournisseurs, mais garde votre compte actif.</p>
            <form action="{{ route('account.clear') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer TOUT votre inventaire ? Cette action est irréversible.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn" style="background: rgba(239, 68, 68, 0.1); color: var(--danger); border: 1px solid var(--danger);">Vider l'inventaire</button>
            </form>
        </div>
        <div>
            <h4 style="margin-bottom: 0.5rem;">Supprimer mon compte</h4>
            <p style="font-size: 0.875rem; color: var(--text-muted); margin-bottom: 1rem;">Supprime définitivement votre compte, vos produits et toutes vos données de la base de données.</p>
            <form action="{{ route('account.delete') }}" method="POST" onsubmit="return confirm('ATTENTION : Voulez-vous supprimer votre COMPTE et TOUTES vos données ? Action irréversible.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn" style="background: var(--danger); color: white;">Supprimer le compte</button>
            </form>
        </div>
    </div>
</div>
@endsection
