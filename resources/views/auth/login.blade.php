@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<div style="display: flex; justify-content: center; align-items: center; min-height: 60vh;">
    <div class="card" style="width: 100%; max-width: 450px; padding: 2.5rem; background: var(--glass); border: 1px solid var(--border);">
        <div style="text-align: center; margin-bottom: 2rem;">
            <h1 style="font-size: 2rem; margin-bottom: 0.5rem;">Bon retour !</h1>
            <p style="color: var(--text-muted);">Connectez-vous pour gérer votre stock</p>
        </div>

        @if($errors->any())
            <div style="background: rgba(239, 68, 68, 0.1); color: var(--danger); padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; border: 1px solid var(--danger); font-size: 0.875rem;">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; color: var(--text-muted);">Email de la PME</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                    style="width: 100%; padding: 0.875rem; border-radius: 0.5rem; background: rgba(255,255,255,0.05); border: 1px solid var(--border); color: white;">
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; color: var(--text-muted);">Mot de passe</label>
                <input type="password" name="password" required
                    style="width: 100%; padding: 0.875rem; border-radius: 0.5rem; background: rgba(255,255,255,0.05); border: 1px solid var(--border); color: white;">
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; font-size: 0.875rem;">
                <label style="display: flex; align-items: center; color: var(--text-muted); cursor: pointer;">
                    <input type="checkbox" name="remember" style="margin-right: 0.5rem;"> Se souvenir de moi
                </label>
                <a href="{{ route('password.request') }}" style="color: var(--primary); text-decoration: none;">Mot de passe oublié ?</a>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem; font-weight: 600;">Se connecter</button>
        </form>

        <div style="margin-top: 2rem; text-align: center; font-size: 0.875rem; color: var(--text-muted);">
            Vous n'avez pas encore de compte ? 
            <a href="{{ route('register') }}" style="color: var(--primary); text-decoration: none; font-weight: 600;">Inscrire ma PME</a>
        </div>
    </div>
</div>
@endsection
