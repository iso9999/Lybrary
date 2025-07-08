# Lybrary Project

Ce dépôt contient un exemple d'application de gestion de bibliothèque. Les principales instructions ci-dessous expliquent l'installation de la base de données, les identifiants par défaut et l'organisation des dossiers.

## Installation de la base `library_demo`

1. Créez une base de données MySQL nommée `library_demo`.
2. Importez le fichier `library_demo.sql` disponible à la racine du dépôt dans cette base. Vous pouvez utiliser phpMyAdmin ou la ligne de commande MySQL :
   ```sh
   mysql -u <utilisateur> -p library_demo < library_demo.sql
   ```

## Identifiants de connexion par défaut

Les identifiants d'administration sont répertoriés dans le fichier `Note.txt` :

- **URL de connexion** : `admin/ad_connexion951.php`
- **Identifiant** : `admin`
- **Mot de passe** : `123456789yo`

## Architecture du projet

- `admin/` : pages et scripts destinés à l'administrateur (gestion des livres, étudiants, etc.).
- `etudiant/` : interfaces réservées aux étudiants pour consulter ou demander des livres.
- `includes/` : fichiers PHP partagés (configuration, entêtes, fonctions...).
- `src/` : ressources statiques (CSS, images, JavaScript).
- `library_demo.sql` : script de création et d'alimentation de la base de données.
- `index.php` : page d'accueil du projet.

## Prérequis

- PHP (version 5.6 ou supérieure conseillée).
- MySQL ou MariaDB pour héberger la base `library_demo`.

Après installation, placez l'application dans un serveur Web compatible PHP et assurez-vous que la connexion à la base correspond aux paramètres définis dans `includes/config.php`.
