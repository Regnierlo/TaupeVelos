<?php
	if(isset($_COOKIE["panier"]) && isset($_GET["nombre"]) && isset($_GET["date"]) && isset($_GET["cle"])){
		$panier = json_decode($_COOKIE["panier"]);		
		include("Parametres.php");
		include("Fonctions.inc.php");
		include("Donnees.inc.php");

		$mysqli=mysqli_connect($host.":".$port,$user,$pass) or die("Problème de création de la base :".mysqli_error());
		mysqli_select_db($mysqli,$base) or die("Impossible de sélectionner la base : $base");
		
		foreach($panier as $item){
			query($mysqli,"replace into commande (ID_PROD,ETAT,ID_CLIENT,DATE,CIVILITE,NOM,PRENOM,ADRESSE,CP,VILLE,TELEPHONE) values ('".$item."',0,'".$_SESSION["login"]."','".date('d/m/Y')."','".$_SESSION["CIVILITE"]."','".$_SESSION["NOM"]."','".$_SESSION["PRENOM"]."','".$_SESSION["ADRESSE"]."','".$_SESSION["CP"]."','".$_SESSION["VILLE"]."','".$_SESSION["TELEPHONE"]."')");
		}
		mysqli_close($mysqli);
	}
	else{
		$_SESSION["erreur"] = "donnees incorrectes";
	}
?>