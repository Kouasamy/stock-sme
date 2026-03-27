<x-mail::message>
# <div style="color: #6366f1; text-align: center; border-bottom: 2px solid #6366f1; padding-bottom: 10px;">Stock Manager</div>

## Bienvenue chez Stock Manager !

Bonjour **{{ $user->name }}**,

Nous sommes ravis de vous compter parmi nous. Votre compte PME a été créé avec succès. 

Vous disposez maintenant d'un outil puissant pour gérer votre inventaire en temps réel, recevoir des conseils stratégiques et optimiser votre rentabilité.

<x-mail::button :url="config('app.url') . '/dashboard'" color="primary">
Accéder à mon Dashboard
</x-mail::button>

### 📦 Prochaines étapes :
1. Créez vos premières **catégories**.
2. Ajoutez vos **produits** et leurs fournisseurs.
3. Cliquez sur **"Plus de conseils"** pour booster votre gestion !

---
*Ceci est un mail automatique, merci de ne pas y répondre.*<br>
**L'équipe Stock Manager**
</x-mail::message>
