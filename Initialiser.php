<html>
<head>
	<title>Initialisation de la base de données</title>
	<meta charset="utf-8" />
</head>

<body>
<?php

  include("Parametres.php");
  include("Fonctions.inc.php");
  include("Donnees.inc.php");

  // Connexion au serveur MySQL
  $mysqli=mysqli_connect($host.":".$port,$user,$pass) or die("Problème de création de la base :".mysqli_error());

  // Suppression / Création / Sélection de la base de données : $base
  query($mysqli,'DROP DATABASE IF EXISTS '.$base);
  query($mysqli,'CREATE DATABASE '.$base);
  mysqli_select_db($mysqli,$base) or die("Impossible de sélectionner la base : $base");


  query($mysqli,"CREATE TABLE IF NOT EXISTS USERS (
					  LOGIN varchar(100)  PRIMARY KEY,
					  EMAIL varchar(200),
					  PASS varchar(100),
					  NOM varchar(50),
					  PRENOM varchar(50),
					  DATE varchar(10),
					  SEXE varchar(10),
					  ADRESSE varchar(500),
					  CODEP varchar(20),
					  VILLE varchar(50),
					  TELEPHONE varchar(50)					  
					) ENGINE=InnoDB DEFAULT CHARSET=latin1;
				");

  query($mysqli,"CREATE TABLE IF NOT EXISTS PRODUITS (
					  ID_PROD int(10) NOT NULL AUTO_INCREMENT,
					  LIBELLE VARCHAR(100) NOT NULL,
					  PRIX float,
					  DESCRIPTIF VARCHAR(500),
					  PHOTO varchar(80),
					  PRIMARY KEY(ID_PROD)
					) ENGINE=InnoDB DEFAULT CHARSET=latin1;
				");

  query($mysqli,"CREATE TABLE IF NOT EXISTS FAVS (
					  LOGIN varchar(200),
					  ID_PROD int(10),
					  FOREIGN KEY (LOGIN) REFERENCES USERS(LOGIN),
					  FOREIGN KEY (ID_PROD) REFERENCES PRODUITS(ID_PROD),
					  PRIMARY KEY(LOGIN,ID_PROD)
					) ENGINE=InnoDB DEFAULT CHARSET=latin1;
				");

	query($mysqli,'CREATE TABLE IF NOT EXISTS `commande` (
  `ID_COM` bigint(20) NOT NULL AUTO_INCREMENT,
  `ID_PROD` int(11) NOT NULL,
  `ETAT` int(1) NOT NULL,
  `CLIENT` varchar(11) NOT NULL,
  `DATE` varchar(40) NOT NULL,
  `CIVILITE` varchar(5) NOT NULL,
  `NOM` varchar(40) NOT NULL,
  `PRENOM` varchar(40) NOT NULL,
  `ADRESSE` varchar(160) NOT NULL,
  `CP` int(11) NOT NULL,
  `VILLE` varchar(80) NOT NULL,
  `TELEPHONE` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_COM`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;');


	query($mysqli,'CREATE TABLE IF NOT EXISTS `HIERARCHIE` (
  `ID_PARENT` int(11) NOT NULL,
  `ID_ENFANT` int(11) NOT NULL,
  PRIMARY KEY (`id_parent`,`id_enfant`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;');


	query($mysqli,'CREATE TABLE IF NOT EXISTS `RUBRIQUE` (
  `ID_RUB` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLE_RUB` varchar(80) NOT NULL,
  PRIMARY KEY (`ID_RUB`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;');

query($mysqli,'CREATE TABLE IF NOT EXISTS `appartient` (
  `id_prod` int(11) NOT NULL,
  `id_rub` int(11) NOT NULL,
  PRIMARY KEY (`id_prod`,`id_rub`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;');

query($mysqli,'CREATE TABLE IF NOT EXISTS `appartient2` (
  `id_prod` int(11) NOT NULL,
  `id_prop` int(11) NOT NULL,
  `valeur_prop` varchar(40) NOT NULL,
  PRIMARY KEY (`id_prod`,`id_prop`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;');

query($mysqli,'CREATE TABLE IF NOT EXISTS `propriete` (
  `id_prop` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_prop` varchar(40) NOT NULL,
  PRIMARY KEY (`id_prop`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;');

  // Insertion
  query($mysqli,"INSERT INTO USERS VALUES ('admin','admin@admin.com','admin','ADMIN','admin','01/01/1999','Homme',NULL,'57000',NULL,'0918633099');");
  query($mysqli,"INSERT INTO RUBRIQUE (LIBELLE_RUB)VALUES ('Indice')");
  query($mysqli,"INSERT INTO RUBRIQUE (LIBELLE_RUB)VALUES ('Ville')");
  query($mysqli,"INSERT INTO RUBRIQUE (LIBELLE_RUB)VALUES ('Route')");
  query($mysqli,"INSERT INTO RUBRIQUE (LIBELLE_RUB)VALUES ('Enfant')");
  query($mysqli,"INSERT INTO RUBRIQUE (LIBELLE_RUB)VALUES ('BMX')");
    query($mysqli,"INSERT INTO RUBRIQUE (LIBELLE_RUB)VALUES ('VTT')");
	    query($mysqli,"INSERT INTO RUBRIQUE (LIBELLE_RUB)VALUES ('Autre')");
  query($mysqli,"INSERT INTO propriete (libelle_prop)VALUES ('213 Street')");
  query($mysqli,"INSERT INTO propriete (libelle_prop)VALUES ('Abrar')");
  query($mysqli,"INSERT INTO propriete (libelle_prop)VALUES ('Adore')");
  query($mysqli,"INSERT INTO propriete (libelle_prop)VALUES ('Alpha')");
  query($mysqli,"INSERT INTO propriete (libelle_prop)VALUES ('Cyclo2')");
  query($mysqli,"INSERT INTO propriete (libelle_prop)VALUES ('Electra')");
  query($mysqli,"INSERT INTO propriete (libelle_prop)VALUES ('Fuji')");
  query($mysqli,"INSERT INTO propriete (libelle_prop)VALUES ('Montana')");
  query($mysqli,"INSERT INTO propriete (libelle_prop)VALUES ('Velonline')");
  query($mysqli,"INSERT INTO propriete (libelle_prop)VALUES ('Autre')");

  query($mysqli,'insert into appartient values(1,(select id_rub from rubrique where libelle_rub = \'Ville\'))');
  query($mysqli,'insert into appartient values(2,(select id_rub from rubrique where libelle_rub = \'Route\'))');
  query($mysqli,'insert into appartient values(1,(select id_prop from propriete where libelle_prop = \'Autre\'))');
  query($mysqli,'insert into appartient values(2,(select id_rub from rubrique where LIBELLE_RUB = \'Autre\'))');
  query($mysqli,'insert into produits (LIBELLE,PRIX,PHOTO,DESCRIPTIF) values (\'VELO RAILWAY LADY 1.5\',\'179\',\'railway-lady-1-5.jpg\',\'Le railway lady 1.5 est un incontournable des vélos urbains. Simple, robuste et versatile, le railway sera votre compagnon de tous les jours pour affronter la ville.\')');
  query($mysqli,'insert into produits (LIBELLE,PRIX,PHOTO,DESCRIPTIF) values (\'VELO SPEGO 105 1.4 GO SPORT\',\'400\',\'spego-105-1-4.jpg\',\'De la route, tout simplement. Le Spego 105 1.4 rend la route accessible à tous. Simple, léger, proposant une position confortable, ce vélo sera parfait pour garder la forme ou même pour aller au travail. Le Spego offre une véritable polyvalence sur route.\')');
 mysqli_close($mysqli);
?>

Initialisation réussie
</body>
</html>
