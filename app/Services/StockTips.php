<?php

namespace App\Services;

class StockTips
{
    protected static $generalTips = [
        "Utilisez la méthode FIFO (First-In, First-Out) pour éviter que vos produits les plus anciens ne se périment ou ne deviennent obsolètes.",
        "Réalisez un inventaire tournant chaque mois au lieu d'un inventaire annuel massif pour une meilleure précision.",
        "Analysez vos produits 'dormants' (ceux qui ne se vendent pas) et envisagez une promotion pour libérer de l'espace.",
        "Maintenez une relation étroite avec vos fournisseurs clés pour négocier des délais de livraison plus courts en cas d'urgence.",
        "Vérifiez régulièrement l'état de votre stock physique par rapport aux données du système pour détecter les pertes ou vols."
    ];

    protected static $categorySpecificTips = [
        'Électronique' => "Le stock de produits électroniques perd de sa valeur rapidement. Ne sur-stockez pas les modèles qui seront bientôt remplacés.",
        'Mobilier' => "L'espace de stockage coûte cher pour les objets volumineux. Optimisez votre rayonnage vertical.",
        'Alimentation' => "La gestion de la chaîne du froid et des dates de péremption est votre priorité absolue.",
    ];

    public static function getPersonalizedTip($products)
    {
        // Si la PME a des produits dans une catégorie spécifique
        foreach ($products as $product) {
            $catName = $product->category->name ?? '';
            if (isset(self::$categorySpecificTips[$catName])) {
                return self::$categorySpecificTips[$catName];
            }
        }

        // Sinon, conseil général aléatoire
        return self::$generalTips[array_rand(self::$generalTips)];
    }
}
