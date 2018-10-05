<?php

	//Si l'id de l'item est défini et si la position est défini alors
	if(isset($_POST["item"])){
		//Création d'un tableau arr1 qui contiendra notre nouveau cookie après supression de l'item
		$arr1 = array();
		//$trouve est vrai quand on aura trouvé l'item à supprimer du panier actuel
		$trouve = false;
		//Si le cookie panier est défini
		if(isset($_COOKIE["panier"])){
			// On crée un tableau contenant le contenu actuel du cookie
			$arr = json_decode($_COOKIE["panier"],true);
				//Pour chaque element dans le tableau $item prend la valeur de l'element (ici l'ID de l'item)
				foreach($arr as $item){
					// Si l'ID de l'item qu'on veut supprimer est le même que celui présent dans mon cookie et qu'on l'a pas déjà trouvé dans une des boucles précédentes alors
					if(($_POST["item"] == $item) && ($trouve == false)){
						//On affirme qu'on a trouvé l'item qu'on veut supprimer
						$trouve = true;
					}else{
						//sinon on ajoute l'item dans arr1 qui sera notre nouveau panier car l'item n'est pas supprimé
						$arr1[] = $item;
				}
			}
		}
		//Si notre nouveau cookie n'est pas null
		if($arr1){
			// on ajoute son contenu en cookie
			setcookie('panier',json_encode($arr1),time() + (60*30), "/", null, false, true);
		}else{
			//sinon on crée un cookie avec rien dedans (et qui expire instantanément)
			setcookie("panier", "", time()-3600, "/", null, false, true);
		}
	}
?>
