<?php
	
	function afficherPromo(){
		include("Parametres.php");
		include("Fonctions.inc.php");		
		// $mysqli=mysqli_connect($host,$user,$pass) or die("Problème de création de la base :".mysqli_error());
		$mysqli=new mysqli($host.":".$port,$user,$pass) or die("Problème de création de la base :".mysqli_error());
		mysqli_select_db($mysqli,$base) or die("Impossible de sélectionner la base : $base");
		$result = query($mysqli,'select * from produits order by id_prod desc limit 1');
		
		if((mysqli_num_rows($result)>0)){
		$row = mysqli_fetch_assoc($result);
		echo '<section id="intro" class="last clear">
        <article >
          <figure><img alt="images/demo/450x250.gif" src="images/'.$row["PHOTO"].'" width="450" height="250" alt="">
            <figcaption>
				<h2>Nouveauté</h2>
              <p><strong>'.$row["LIBELLE"].'</strong></p>
              <p>'.$row["DESCRIPTIF"].'</p>
              <footer class="more"><a href="details.php?prod='.$row["ID_PROD"].'">Afficher détails</a></footer>
            </figcaption>
          </figure>
        </article>
      </section>';
		}
		else{
			echo '<H2>Nouveautés</h2>';
			echo '<p>pas de produits dans la base de données</p>';
		}
		
		mysqli_close($mysqli);
	}


?>