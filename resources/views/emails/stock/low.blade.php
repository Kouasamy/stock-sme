<x-mail::message>
# Alerte de Stock Bas

Le produit **{{ $product->name }}** (SKU: {{ $product->sku }}) a atteint son seuil critique.

**Stock actuel :** {{ $product->stock_quantity }}  
**Seuil d'alerte :** {{ $product->low_stock_threshold }}

<x-mail::button :url="config('app.url') . '/products/' . $product->id">
Voir le produit
</x-mail::button>

Merci,<br>
{{ config('app.name') }}
</x-mail::message>
