<?php
	if(isset($_POST["item"])){
		if(isset($_COOKIE["panier"])){
			$arr = json_decode($_COOKIE["panier"],true);
			$arr[] = $_POST["item"];
			setcookie('panier',json_encode($arr),time() + (60*30), "/", null, false, true);
			echo "Produit ajouté au panier";
		}
		else{
			$arr[] = $_POST["item"];
			setcookie('panier',json_encode($arr),time() + (60*30),  "/", null, false, true);
			echo "Produit ajouté au panier";
		}
	}
	else{
		echo "Erreur";
	}
?>
