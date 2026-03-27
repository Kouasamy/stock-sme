@extends('layouts.app')

@section('title', 'Mot de passe oublié')

@section('content')
<div style="display: flex; justify-content: center; align-items: center; min-height: 60vh;">
    <div class="card" style="width: 100%; max-width: 450px; padding: 2.5rem; background: var(--glass); border: 1px solid var(--border);">
        <div style="text-align: center; margin-bottom: 2rem;">
            <h1 style="font-size: 2rem; margin-bottom: 0.5rem;">Récupération</h1>
            <p style="color: var(--text-muted);">Saisissez votre email pour recevoir un lien</p>
        </div>

        @if(session('success'))
            <div style="background: rgba(16, 185, 129, 0.1); color: var(--success); padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; border: 1px solid var(--success); font-size: 0.875rem;">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div style="background: rgba(239, 68, 68, 0.1); color: var(--danger); padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; border: 1px solid var(--danger); font-size: 0.875rem;">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div style="margin-bottom: 2rem;">
                <label style="display: block; margin-bottom: 0.5rem; color: var(--text-muted);">Email de la PME</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                    style="width: 100%; padding: 0.875rem; border-radius: 0.5rem; background: rgba(255,255,255,0.05); border: 1px solid var(--border); color: white;">
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem; font-weight: 600;">Envoyer le lien</button>
        </form>

        <div style="margin-top: 2rem; text-align: center; font-size: 0.875rem; color: var(--text-muted);">
            Se souvenir du mot de passe ? 
            <a href="{{ route('login') }}" style="color: var(--primary); text-decoration: none; font-weight: 600;">Se connecter</a>
        </div>
    </div>
</div>
@endsection
