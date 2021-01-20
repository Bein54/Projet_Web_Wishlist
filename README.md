# Projet_Web_Wishlist

Pour lancer l'application, il faut :

 créer la table reservation :
 
 DROP TABLE IF EXISTS `reservation`;
 create table reservation (
idReservation int(11) NOT NULL AUTO_INCREMENT PRIMARY Key,
idItem int(11) not null,
Identifiant varchar(50),
FOREIGN KEY(idItem)REFERENCES item(id)
)
 DROP TABLE IF EXISTS `utilisateur`;
 create table utilisateur (
idUser int(11) NOT NULL AUTO_INCREMENT PRIMARY Key,
MotDePasse varchar(50) Not NULL,
Identifiant varchar(50) NOT NULL
)




URL de l'application :

Liste des fonctionnalités :

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