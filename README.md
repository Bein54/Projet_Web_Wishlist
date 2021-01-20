# Projet_Web_Wishlist

## Pour lancer l'application, il vous faut :

### Créer un fichier 'database.ini' dans le répertoire 'src/conf' contenant le code suivant :
 
`driver` = "_votre driver_"

`host` = "_votre host_"

`database` = "_le nom de votre base de données_"

`username` = "_votre nom d'utilisateur_"

`password` = "_votre mot de passe_"

`charset` = "_votre charset_"

`collation` = "_votre collation_"


## Créer la table reservation :
 
drop table reservation;
create table reservation (
    idReservation int(11) NOT NULL AUTO_INCREMENT PRIMARY Key,
    identifiant varchar(50) not null,
    idItem int(11) not null,
    FOREIGN KEY(idItem)REFERENCES item(id)
    );

DROP TABLE IF EXISTS `utilisateur`;
create table utilisateur (
    idUser int(11) NOT NULL AUTO_INCREMENT PRIMARY Key,
    MotDePasse varchar(50) Not NULL,
    Identifiant varchar(50) NOT NULL
);




## URL de l'application

## Liste des fonctionnalités

Sélection et affichage de la liste des listes de souhait : 
URL : 
Réalisée par : NICOL Benoît / FERAUX Julien

Détail d'une liste : 
URL :
Réalisée par : VRIGNON Quentin / NICOL Benoît

Sélection d’un item d’une liste :
URL :
Réalisée par : VRIGNON Quentin

Créer une liste : 
URL : 
Réalisée par : SCHMITT Léonard

Partage des URL :
URL : 
Réalisée par : VRIGNON Quentin

Ajout d'un item à une liste : 
URL :
Réalisée par : VRIGNON Quentin
