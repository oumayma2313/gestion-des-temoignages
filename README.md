# Gestion des Témoignages

Après le téléchargement du code il faut créer une base de données nommé test\_egio

## Description

Ce projet permet d'enregistrer un témoignage par le client, et l'administrateur a la possibilité d'approuver ou de rejeter ce témoignage.

## Les commandes

#### Pour installer ou mettre à jour les dépendances :

```
composer i
```

ou

```
composer update
```

#### Pour créer les tables dans la base de données :

```
php bin/console doctrine:migrations:diff
```

```
php bin/console doctrine:migrations:migrate
```

#### Pour démarrer le serveur : 

```
php bin/console server:run
```

## Screens

#### Pour la partie client :

http://127.0.0.1:8000/home

Le client remplit les champs du formulaire, ensuite un message de succès est affiché.



Seuls les témoignages approuvés par l'administrateur sont affichés. Il y a aussi la possibilité de définir l’ordre des témoignages par "Drag&Drop".



#### Pour la partie admin:

http://127.0.0.1:8000/admin

Le tableau affiche les données nécessaires comme la date de création du témoignage ainsi que son statut.

L'administrateur approuve ou rejeté un témoignage par un simple click.



Une page de confirmation s'affiche quand l'administrateur click sur le bouton rejeter.



http://127.0.0.1:8000/refus

Ici on trouve la liste des témoignages rejetés.

