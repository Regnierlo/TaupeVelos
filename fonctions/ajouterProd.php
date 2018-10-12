<?php
	function ajouterProduit(){
		include("Parametres.php");
		include("Fonctions.inc.php");
		include("Donnees.inc.php");

		$mysqli=mysqli_connect($host.":".$port,$user,$pass) or die("Problème de création de la base :".mysqli_error());
		mysqli_select_db($mysqli,$base) or die("Impossible de sélectionner la base : $base");
		$result = query($mysqli,"select distinct LIBELLE_RUB from RUBRIQUE");
		$result2 = query($mysqli,"select distinct libelle_prop from propriete");
		echo "<h2>Ajouter produit</h2><br/>";
		echo "<form  enctype='multipart/form-data' action='fonctions/ajouterProdd.php' method='post' class='putImages'>";
		echo "<table>";
		echo "<tr><td wnameth='180px'>Libelle</td><td><input type='text' name='libelle'></input></td></tr>";
		echo "<tr><td>Prix</td><td><input type='text' name='prix'></input></td></tr>";
		echo "<tr><td>Descriptif</td><td><input type='text' name='descriptif'></input></td></tr>";

		echo "<tr><td>Marque</td><td><select name='propriete' style='wnameth:145px'>";
		while($row = mysqli_fetch_assoc($result2)){
			echo "<option>".$row["libelle_prop"]."</option>";
			}
		echo "</select></td></tr>";


		echo "<tr><td>Rubrique</td><td><select name='rubrique' style='wnameth:145px'>";
		while($row = mysqli_fetch_assoc($result)){
			echo "<option>".$row["LIBELLE_RUB"]."</option>";
			}

		echo "</select></td></tr>";



		echo "<tr><td>Image</td><td><input id='file' name='file' type='file' multiple/></td></tr>";
		echo "<tr><td><br/><input name='valider' type='submit' value='Valider' onclick='ajouterProdd();'/></td></tr>";
		echo "</table>";
		echo "</form>";
		mysqli_close($mysqli);
	}
?>
