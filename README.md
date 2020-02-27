AdHere API
=================

Groupe 15
---------------

- Saoud Imed
- Corentin Thibault
- Haris Souici
- Donaelle Walter

## Prérequis
- mysql
- composer
- php7

## Génération de la base de donnée 

- Clonez le projet
- Placez-vous dans le dossier adHere-API/db/config et executez la commande : `mysql -u root -p < db_structure.sql` 

## Insertion de la donnée

- Placez-vous dans le dossier adHere-API/db/config et executez la commande : `php db_insert_data.php `

## Lancement de l'API

- Mettez-vous à la racine du projet et exécutez la commande : `composer install`
- Créez un fichier `.env.local` à la racine du projet
- Copiez le contenu du `.env` à la racine du dossier server et collez le dans votre fichier `.env.local`
- Dans le fichier `.env.local` décommentez la variable `DATABASE_URL` et remplacé son contenu par votre configuration mysql
- Lancez l'api avec la commande : `symfony serve`

**Documentation de l'API : [ici !](https://greenparis.docs.apiary.io)**



