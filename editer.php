<!DOCTYPE html>
<?php

include 'fonctions/profil.php';
	session_start();
	if(isset($_SESSION["login"])){
		  include("Parametres.php");
		  include("Fonctions.inc.php");
		  include("Donnees.inc.php");
		  $mysqli=mysqli_connect($host.":".$port,$user,$pass) or die("Problème de création de la base :".mysqli_error());
		  mysqli_select_db($mysqli,$base) or die("Impossible de sélectionner la base : $base");
				$str = "SELECT LOGIN,EMAIL,PASS,NOM,PRENOM,DATE,SEXE,ADRESSE,CODEP,VILLE,TELEPHONE FROM USERS WHERE LOGIN = '".$_SESSION["login"]."'";
				$result = query($mysqli,$str) or die("Impossible de se connecter");
				$row = mysqli_fetch_assoc($result);
				if(is_null($row["LOGIN"])){$login = "";}else{$login = $row["LOGIN"];}
				if(is_null($row["EMAIL"])){$email = "";}else{$email = $row["EMAIL"];}
				if(is_null($row["NOM"])){$nom = "";}else{$nom = $row["NOM"];}
				if(is_null($row["PRENOM"])){$prenom = "";}else{$prenom = $row["PRENOM"];}
				if(is_null($row["DATE"])){$date = "";}else{$date = $row["DATE"];}
				if(is_null($row["TELEPHONE"])){$telephone = "";}else if((int)$row["TELEPHONE"] == 0){ $telephone = NULL;}else{$telephone = $row["TELEPHONE"];}
				if(is_null($row["ADRESSE"])){$adresse = "";}else{$adresse = $row["ADRESSE"];}
				if(is_null($row["CODEP"])){$codepostal = "";}else{$codepostal = $row["CODEP"];}
				if(is_null($row["VILLE"])){$ville = "";}else{$ville = $row["VILLE"];}
				if(is_null($row["SEXE"])){$sexe = "";}else{$sexe = $row["SEXE"];}
		  mysqli_close($mysqli);
	}

?>
<html lang="fr" dir="ltr">
<head>
<title>TaupeVélos</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="styles/layout.css" type="text/css">
<!--[if lt IE 9]><script src="scripts/html5shiv.js"></script><![endif]-->
</head>
<body>

<?php include 'navbar.php';?>

<!-- content -->
<div class="wrapper row2">
  <div id="container" class="clear">
    <!-- main content -->
    <div name="homepage" style="min-height:400px">
	<?php
								echo '<form action="update.php" method="post">';
									if(isset($row["LOGIN"])){
										echo "
										<table wnameth='30%'>
										<tr>
											<th><hr></th>
										</tr>
										<tr>
											<td><p><strong>Email</strong></p></td><td><input name='emailbdd' type=\"text\" placeholder=\"".$email."\"/></td>
										</tr>
										<tr>
											<td><p><strong>Nom</strong></p></td><td><input name='nombdd' type=\"text\" placeholder=\"".$nom."\"/></td>
										</tr>

										<tr>
											<td><p><strong>Prénom</strong></p></td><td><input name='prenombdd' type=\"text\" placeholder=\"".$prenom."\"/></td>
										</tr>
										<tr>
											<td><p><strong>Date de Naissance</strong></p></td><td><input name='datebdd' type=\"date\" placeholder=\"".$date."\"/></td>
										</tr>
										<tr>
											<td><p><strong>Telephone</strong></p></td><td><input name='telephonebdd' type=\"text\" placeholder=\"".$telephone."\"/></td>
										</tr>

										<tr>
											<td><p><strong>Adresse</strong></p></td><td><textarea name='adressebdd' rows=\"4\" placeholder=\"".$adresse."\"></textarea></td>
										</tr>
										<tr>
											<td><p><strong>Ville</strong></p></td><td><input name='villebdd' type=\"text\" placeholder=\"".$ville."\"/></td>
										</tr>
										<tr>
											<td><p><strong>Code Postal</strong></p></td><td><input name='postalbdd' type=\"text\" placeholder=\"".$codepostal."\"/></td>
										</tr>
                                        <tr>
                                        <td><p><strong>Mot de passe</strong></p></td><td><input name='passwordbdd' type=\"password\"/></td>
										</tr>
																				<tr>
										<tr>
											<td><p><strong>Sexe</strong></p></td><td><input type='radio' name='optradio' value='Femme'/>Femme     <input type='radio' name='optradio' checked='' value='Homme'/>Homme</td>
										</tr>
										<tr>
											<td colspan='2'><hr></td>
										</tr>
											<td><input type='submit' value='Valider'/></td>
										</tr>
										</table>";
									echo '</form>';
									}
									else{
										echo "<font color='grey'>Connectez vous pour afficher cette page</font>";
									}
								?>
      <!-- / Introduction -->
    </div>
    <!-- / content body -->
  </div>
</div>
<!-- Footer -->
<!-- Copyright -->
<?php include 'foot.php';?>
</body>
</html>
