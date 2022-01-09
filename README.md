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
![1](https://user-images.githubusercontent.com/86934489/148700082-7cbe041d-036e-489b-8f5d-44b6e7f12727.PNG)
![3](https://user-images.githubusercontent.com/86934489/148700131-aca5fcda-bc03-4b7a-b07c-9447dda44743.PNG)

Seuls les témoignages approuvés par l'administrateur sont affichés. Il y a aussi la possibilité de définir l’ordre des témoignages par "Drag&Drop".
![2](https://user-images.githubusercontent.com/86934489/148700136-833832b5-f52f-4da3-a5b7-ae23e3d58760.PNG)

#### Pour la partie admin:

http://127.0.0.1:8000/admin

Le tableau affiche les données nécessaires comme la date de création du témoignage ainsi que son statut.

L'administrateur approuve ou rejeté un témoignage par un simple click.
![4](https://user-images.githubusercontent.com/86934489/148700150-8aef773e-8275-44b3-83dc-bdd7358aad99.PNG)

Une page de confirmation s'affiche quand l'administrateur click sur le bouton rejeter.
![5](https://user-images.githubusercontent.com/86934489/148700151-5d9e4db9-5438-4974-a563-f9b62260a5b7.PNG)

http://127.0.0.1:8000/refus

Ici on trouve la liste des témoignages rejetés.
![6](https://user-images.githubusercontent.com/86934489/148700177-018ae148-bbc9-4d9e-b931-27d3cd940780.PNG)

