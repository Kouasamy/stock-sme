<x-mail::message>
# <div style="color: #6366f1; text-align: center; border-bottom: 2px solid #6366f1; padding-bottom: 10px;">Stock Manager</div>

# 💡 Votre Conseil Intelligence Stock

Bonjour **{{ $user->name }}**,

Voici une recommandation stratégique basée sur l'activité de votre inventaire :

---

### Le conseil du jour
> **"{{ $tip }}"**

---

<x-mail::panel>
Une bonne gestion de stock permet d'économiser jusqu'à 20% sur les coûts opérationnels annuels d'une PME. Appliquez ce conseil dès aujourd'hui !
</x-mail::panel>

<x-mail::button :url="config('app.url') . '/dashboard'">
Voir mon Inventaire complet
</x-mail::button>

Cordialement,<br>
**L'assistant Stock Manager**
</x-mail::message>
