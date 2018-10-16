<?php
	session_start();
	/* 
	Si le panier est défini ET
	Si le login de la session est défini ET
	Si le num de la carte est défini ET
	Si le code de la carte est défini alors
	*/
	if(isset($_COOKIE["panier"]) && isset($_SESSION["login"]) && isset($_POST["num"]) && isset($_POST["code"])){

		/*
		Si la numéro de la carte n'est pas vide ou si le code n'est pas vide alors
		*/
		if(!empty($_POST["num"]) && !empty($_POST["code"])){

					// Variable panier prends prends le contenu du panier
					$panier = json_decode($_COOKIE["panier"]);		
					include("Parametres.php");
					include("Fonctions.inc.php");
					include("Donnees.inc.php");

					//connexion à la BDD
					$mysqli=mysqli_connect($host,$user,$pass) or die("Problème de création de la base :".mysqli_error());
					mysqli_select_db($mysqli,$base) or die("Impossible de sélectionner la base : $base");
					
					//Pour chaque item dans panier (qui est un tableau car anciennement contenu du cookie)
					foreach($panier as $item){

						//Il crée une requète SQL qui remplace dans la table commande les ID ETAT DATE NOM PRENOM ADRESSE CO VILL TEL ...
						query($mysqli,"replace into commande (ID_PROD,ETAT,CLIENT,DATE,CIVILITE,NOM,PRENOM,ADRESSE,CP,VILLE,TELEPHONE) values ('".$item."',0,'".$_SESSION["login"]."','".date('d/m/Y')."','".$_SESSION["CIVILITE"]."','".$_SESSION["NOM"]."','".$_SESSION["PRENOM"]."','".$_SESSION["ADRESSE"]."','".$_SESSION["CP"]."','".$_SESSION["VILLE"]."','".$_SESSION["TELEPHONE"]."')");
					}

					//On met ensuite à jour le cookie panier, on le vide pour le supprimer
					setcookie("panier", "", time()-3600,"/");
					mysqli_close($mysqli);

					$_SESSION["paiement"] = "opération réussie";
					header('location: panier.php');
					exit();
		} // Si code carte vide ou
		$_SESSION["paiement"] = "donnees incorrectes";
		header('location: panier.php');
		exit();
	}
?>