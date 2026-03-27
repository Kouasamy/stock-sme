@extends('layouts.app')

@section('title', 'Nouveau mot de passe')

@section('content')
<div style="display: flex; justify-content: center; align-items: center; min-height: 60vh;">
    <div class="card" style="width: 100%; max-width: 450px; padding: 2.5rem; background: var(--glass); border: 1px solid var(--border);">
        <div style="text-align: center; margin-bottom: 2rem;">
            <h1 style="font-size: 2rem; margin-bottom: 0.5rem;">Nouveau passe</h1>
            <p style="color: var(--text-muted);">Définissez votre nouveau mot de passe</p>
        </div>

        @if($errors->any())
            <div style="background: rgba(239, 68, 68, 0.1); color: var(--danger); padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; border: 1px solid var(--danger); font-size: 0.875rem;">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; color: var(--text-muted);">Confirmer votre Email</label>
                <input type="email" name="email" value="{{ request()->email }}" required
                    style="width: 100%; padding: 0.875rem; border-radius: 0.5rem; background: rgba(255,255,255,0.05); border: 1px solid var(--border); color: white;">
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; color: var(--text-muted);">Nouveau mot de passe</label>
                <input type="password" name="password" required autofocus
                    style="width: 100%; padding: 0.875rem; border-radius: 0.5rem; background: rgba(255,255,255,0.05); border: 1px solid var(--border); color: white;">
            </div>

            <div style="margin-bottom: 2rem;">
                <label style="display: block; margin-bottom: 0.5rem; color: var(--text-muted);">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" required
                    style="width: 100%; padding: 0.875rem; border-radius: 0.5rem; background: rgba(255,255,255,0.05); border: 1px solid var(--border); color: white;">
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem; font-weight: 600;">Réinitialiser</button>
        </form>
    </div>
</div>
@endsection
