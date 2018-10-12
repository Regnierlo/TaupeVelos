<?php
	session_start();
	$file_result = '';
	if($_FILES['file']['error']>0 && (!preg_match("/.jpg$/",$_FILES['file']['name']) || !preg_match("/.png$/",$_FILES['file']['name']) || !preg_match("/.bmp$/",$_FILES['file']['name']) || !preg_match("/.jpeg$/",$_FILES['file']['name']))){
		$_SESSION["produit"] = "Données incorrectes";
		header('location: ../ajouterProd.php');

	}else{
		$file_result = $_FILES['file']['name'];
		move_uploaded_file($_FILES['file']['tmp_name'],'../images/'.$file_result);

		include("../Parametres.php");
		include("../Fonctions.inc.php");
		include("../Donnees.inc.php");

		$mysqli=mysqli_connect($host.":".$port,$user,$pass) or die("Problème de création de la base :".mysqli_error());
		mysqli_select_db($mysqli,$base) or die("Impossible de sélectionner la base : $base");

		if(isset($_POST["libelle"]) && isset($_POST["prix"]) && isset($_POST["descriptif"])){

			$ok = true;
			//Regex pour le libelle des l'ajout d'un produit en admin pas utilise car tout est utilisé
			//if(!preg_match('/^([A-Za-z]{0,80}$)/', $_POST["libelle"])){
			//	$ok = false;
			//}

			if(!preg_match('/^([0-9]+$)/', $_POST["prix"])){
					$ok = false;
			}

				if($ok){
					$prop = mysqli_real_escape_string($mysqli,$_POST["propriete"]);
					$libelle = mysqli_real_escape_string($mysqli,$_POST["libelle"]);
					$prix = mysqli_real_escape_string($mysqli,$_POST["prix"]);
					$descriptif = mysqli_real_escape_string($mysqli,$_POST["descriptif"]);
					$rubrique = mysqli_real_escape_string($mysqli,$_POST["rubrique"]);

					query($mysqli,"replace into `produits` (`Libelle`,`Prix`,`descriptif`,`photo`) values ('".$libelle."','".$prix."','".$descriptif."','".$file_result."')");
					query($mysqli,'insert into appartient (id_prod,id_rub) values ((select max(id_prod) from produits),(select id_rub from rubrique where libelle_rub = \''.$rubrique.'\'))');
					query($mysqli,'insert into appartient2 (id_prod,id_prop,valeur_prop) values ((select max(id_prod) from produits),(select id_prop from propriete where libelle_prop = \''.$prop.'\'),(select libelle_prop from propriete where libelle_prop = \''.$prop.'\'))');

					echo "Enregistrement reussi";
				}
				else
				{
							$_SESSION["produit"] = "Données incorrectes";
							header('location: ../ajouterProd.php');
				}



		}else{
					$_SESSION["produit"] = "Données incorrectes";
					header('location: ../ajouterProd.php');
		}

		mysqli_close($mysqli);
		header('location: ../produits.php');
	}

	//libelle, prix, descriptif, image
?>
