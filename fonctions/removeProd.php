<?php
	session_start();
	if(isset($_POST["item"])){
		include("../Parametres.php");
		include("../Fonctions.inc.php");
		include("../Donnees.inc.php");
			$mysqli=mysqli_connect($host.":".$port,$user,$pass) or die("Problème de création de la base :".mysqli_error());
			mysqli_select_db($mysqli,$base) or die("Impossible de sélectionner la base : $base");
			//effacer la photo quand on efface un produit
			$item = $_POST["item"];
		 	$sql = "SELECT photo FROM produits WHERE id_prod = '".$item."'";
		 	$result = query($mysqli,$sql) or die ("Impossible de se connection à la base de données<br>");
			$row = mysqli_fetch_assoc($result);
		 	$maphoto=$row["photo"];
		 	unlink("../images/".$maphoto);
			//effacer le produit et les résidut dans appartient et appartient2
			query($mysqli,'delete from produits where id_prod = '.$_POST["item"]);
			query($mysqli,'delete from appartient where id_prod = '.$_POST["item"]);
			query($mysqli,'delete from appartient2 where id_prod = '.$_POST["item"]);

			mysqli_close($mysqli);
	}
	else{
		echo "Erreur";
	}
?>
