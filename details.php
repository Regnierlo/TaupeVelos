<!DOCTYPE html>
<?php 
session_start(); 

?>
<html lang="fr" dir="ltr">
<head>
<title>TaupeVélos</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="styles/layout.css" type="text/css">
<!--[if lt IE 9]><script src="scripts/html5shiv.js"></script><![endif]-->
<script src="js/jquery.min.js"></script>
		<script>
			$().ready(function() {
				$('h2 a').click(function (e){
				e.preventDefault();				
				});
			});
			
			function addPanier(e){
				$.ajax({
					type: 'POST',
					url: 'fonctions/panier.php',
					data: {item : e},
					success: function(data){
								alert(data);					
					},
				});
			};	
			</script>
</head>
<body>
<?php include 'navbar.php';?>
<div class="wrapper row2">
  <div id="container" class="clear">
    <!-- main content -->
    <div id="homepage">
      <!-- Services -->
		  <?php 		
				include("Parametres.php");
				include("Fonctions.inc.php");
				$mysqli=mysqli_connect($host.":".$port,$user,$pass) or die("Problème de création de la base :".mysqli_error());
				mysqli_select_db($mysqli,$base) or die("Impossible de sélectionner la base : $base");
				$result = query($mysqli,'select * from rubrique');
			?>
      <section id="services" class="clear">
        <article class="one_third">
		<?php 
		if(isset($_GET["prod"])){
			echo '<h4>Produits</h4><hr>';
			$result = query($mysqli,'select * from produits where id_prod = \''.$_GET["prod"].'\'');
			
			if((mysqli_num_rows($result)>0)){
					while($row = mysqli_fetch_assoc($result)){
						
					echo '<article class="one_third">
						  <figure><img src="images/'.$row["PHOTO"].'" width="290" height="180" alt="">
							<figcaption>
							  <h2><a href="#" onclick="addPanier('.$row["ID_PROD"].')">ACHETER</a> '.$row["LIBELLE"].'</h2>
							  <p>'.$row["DESCRIPTIF"].'</p>
							</figcaption>
						  </figure>
						</article>';
					}
			}
			else
			{
				echo '<p>Produit pas trouvé</p>';
			}
		}else if((isset($_SESSION["login"]) && $_SESSION["login"]== 'admin') && isset($_GET["login"])){
			echo '<h4>Clients</h4><hr>';
			$str = "SELECT LOGIN,EMAIL,PASS,NOM,PRENOM,DATE,SEXE,ADRESSE,CODEP,VILLE,TELEPHONE FROM USERS WHERE LOGIN = '".$_GET["login"]."'";
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
				
				
				if(isset($row["LOGIN"])){
										echo "					
										<table width='30%'>
										<tr>
											<td><p><strong>Email</strong></p></td><td>".$email."</td>
										</tr>
										<tr>
											<td><p><strong>Nom</strong></p></td><td>".$nom."</td>
										</tr>
										
										<tr>
											<td><p><strong>Prénom</strong></p></td><td>".$prenom."</td>
										</tr>
										<tr>
											<td><p><strong>Date de Naissance</strong></p></td><td>".$date."</td>
										</tr>
										<tr>
											<td><p><strong>Telephone</strong></p></td><td>".$telephone."</td>
										</tr>
										
										<tr>
											<td><p><strong>Adresse</strong></p></td><td>".$adresse."</td>
										</tr>
										<tr>
											<td><p><strong>Ville</strong></p></td><td>".$ville."</td>
										</tr>
										<tr>
											<td><p><strong>Code Postal</strong></p></td><td>".$codepostal."</td>
										</tr>
										<tr>
										<tr>
											<td><p><strong>Sexe</strong></p></td><td>".$sexe."</td>
										</tr>
										</table>";
									}
				
		}
		mysqli_close($mysqli);
		?>
      </section>
      <!-- / Services -->
    </div>
    <!-- / content body -->
  </div>
</div>
<!-- Copyright -->
<?php include 'foot.php';?>
</body>
</html>
