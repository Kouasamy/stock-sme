# Stock Manager SME - Système de Gestion de Stocks Isolé

---

## PRÉSENTATION DU PROJET

### 1. Objectif du Projet
Stock Manager SME est une application web conçue pour moderniser la gestion des inventaires des petites et moyennes entreprises. L'objectif est de remplacer les méthodes de suivi manuelles par une plateforme centralisée permettant de suivre en temps réel les niveaux de stock, les mouvements d'entrée/sortie, et de recevoir des conseils de gestion automatisés.

### 2. Le Problème Technique Résolu
Ce projet apporte une réponse concrète à plusieurs problématiques majeures du secteur :
- Isolation des Données (Multi-Tenancy) : L'architecture logicielle garantit une séparation stricte au niveau utilisateur (user_id). Chaque PME gère son propre inventaire, ses catégories et ses fournisseurs sans risque de fuite de données entre comptes.
- Audit et Traçabilité : L'intégration de journaux d'activité permet de tracer chaque modification de prix ou de quantité, rendant l'entreprise "Audit-Ready" pour ses inventaires de fin d'année.
- Communication Professionnelle et Automatisation (Resend) : Le projet intègre l'API Resend pour transformer la gestion de stock en un outil de conseil proactif. Le système automatise l'envoi de conseils stratégiques et d'alertes de rupture de stock via des mails haute fidélité (HTML/CSS), garantissant que les informations critiques parviennent aux décideurs sans passer par les dossiers SPAM.
- Complexité Réduite : Contrairement aux ERP lourds, Stock Manager SME se concentre sur l'essentiel avec une interface épurée et une base de données légère (SQLite), idéale pour un déploiement rapide.

---

## INTÉGRATION TECHNIQUE DE RESEND

L'envoi de mails a été conçu pour être à la fois performant et esthétique :
- Infrastructure : Utilisation du driver Resend pour Laravel, remplaçant le protocole SMTP classique par des requêtes API sécurisées.
- Design des Mails : Les notifications utilisent le moteur de rendu Markdown de Laravel, converti en HTML responsive pour un affichage optimal sur mobile et ordinateur.
- Automatisation : Déclenchement automatique de conseils personnalisés basés sur l'analyse algorithmique des niveaux de stock actuels.
- Délivrabilité : Configuration optimisée pour assurer que 100% des mails de gestion arrivent en boîte de réception.

---

## ARCHITECTURE & TECH STACK

La plateforme utilise des technologies modernes pour assurer stabilité et simplicité :

- Framework : Laravel 12 (PHP 8.2+)
- Base de Données : SQLite pour une portabilité maximale
- Sécurité : Système d'authentification robuste avec isolation par user_id
- Emailing : API Resend pour une délivrabilité garantie
- Traçabilité : Laravel Activity Log pour l'audit complet du système
- Interface : Vanilla CSS avec design moderne (Glassmorphism)

---

## INSTALLATION & DÉMARRAGE

1. Pré-requis : PHP 8.2+, Composer.
2. Installation :
   ```bash
   composer install
   php artisan migrate:fresh --seed
   php artisan serve
   ```
3. Configuration : Renseignez votre clé API Resend dans le fichier .env pour activer les notifications mail.

---

## CRÉDITS & DÉVELOPPEMENT

Ce projet a été réalisé avec une attention particulière à la fiabilité de la logique métier et à la protection des données sensibles des PME.

**Développé par : Kouat Ekra Samuel**
*Mars 2026*

---
© 2026 Stock Manager SME - La gestion de stock simplifiée pour les PME.
