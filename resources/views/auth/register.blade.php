@extends('layouts.app')

@section('title', 'Inscription PME')

@section('content')
<div style="max-width: 500px; margin: 4rem auto;">
    <div class="card" style="padding: 2.5rem;">
        <h2 style="margin-bottom: 2rem; text-align: center;">Inscrivez votre PME</h2>
        
        <form action="{{ route('register') }}" method="POST">
            @csrf
            
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; color: var(--text-muted);">Nom de l'entreprise / Responsable</label>
                <input type="text" name="name" required style="width: 100%; padding: 0.75rem; border-radius: 0.5rem; background: var(--glass); border: 1px solid var(--border); color: white;">
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; color: var(--text-muted);">E-mail professionnel</label>
                <input type="email" name="email" required style="width: 100%; padding: 0.75rem; border-radius: 0.5rem; background: var(--glass); border: 1px solid var(--border); color: white;">
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; color: var(--text-muted);">Mot de passe</label>
                <input type="password" name="password" required style="width: 100%; padding: 0.75rem; border-radius: 0.5rem; background: var(--glass); border: 1px solid var(--border); color: white;">
            </div>

            <div style="margin-bottom: 2rem;">
                <label style="display: block; margin-bottom: 0.5rem; color: var(--text-muted);">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" required style="width: 100%; padding: 0.75rem; border-radius: 0.5rem; background: var(--glass); border: 1px solid var(--border); color: white;">
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem;">Créer mon compte</button>
        </form>
    </div>
</div>
@endsection
