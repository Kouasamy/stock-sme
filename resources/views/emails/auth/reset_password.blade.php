<x-mail::message>
# <div style="color: #6366f1; text-align: center; border-bottom: 2px solid #6366f1; padding-bottom: 10px;">Stock Manager</div>

## Réinitialisation de mot de passe

Bonjour **{{ $user->name }}**,

Vous recevez cet email car nous avons reçu une demande de réinitialisation de mot de passe pour votre compte **Stock Manager**.

<x-mail::button :url="url('/password/reset/' . $token . '?email=' . urlencode($user->email))" color="primary">
Réinitialiser mon mot de passe
</x-mail::button>

Ce lien de réinitialisation expirera dans 60 minutes.

Si vous n'avez pas demandé de réinitialisation de mot de passe, aucune autre action n'est requise de votre part.

Cordialement,<br>
**L'équipe Stock Manager**

<x-mail::panel>
Si vous rencontrez des problèmes avec le bouton ci-dessus, copiez et collez l'URL ci-dessous dans votre navigateur :
[{{ url('/password/reset/' . $token . '?email=' . urlencode($user->email)) }}]({{ url('/password/reset/' . $token . '?email=' . urlencode($user->email)) }})
</x-mail::panel>
</x-mail::message>
