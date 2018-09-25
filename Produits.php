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
			
			function rubrique(){
				window.location.href = "Produits.php?rub=" + $('#sel option:selected').text() + "&prop=" + $('#sel1 option:selected').text() + "&prix=" + $('#sel2 option:selected').text();
			}
			</script>
</head>
<body>
<?php include 'navbar.php';?>
<div class="wrapper row2">
  <div id="container" class="clear">
    <!-- main content -->
    <div id="homepage">
      <!-- Services -->
	  <h4>Categorie</h4>
	  Rubrique: <select id="sel" onchange="rubrique();">
		  <?php 		
				include("Parametres.php");
				include("Fonctions.inc.php");
				$mysqli=mysqli_connect($host,$user,$pass) or die("Problème de création de la base :".mysqli_error());
				mysqli_select_db($mysqli,$base) or die("Impossible de sélectionner la base : $base");
				$result = query($mysqli,'select * from rubrique');
						
				if((mysqli_num_rows($result)>0)){
					while($row = mysqli_fetch_assoc($result)){
							if(isset($_GET["rub"]) && $_GET["rub"] == $row["LIBELLE_RUB"]){
								echo '<option selected>';
							}
							else{
								echo '<option>';
							}
						echo $row["LIBELLE_RUB"].'</option>';
					}
				}
			?>
		</select>
			Marque: <select id="sel1" onchange="rubrique();">
		  <?php 		
				$result = query($mysqli,'select * from propriete');
				echo '<option>--</option>';		
				if((mysqli_num_rows($result)>0)){
					while($row = mysqli_fetch_assoc($result)){
							if(isset($_GET["prop"]) && $_GET["prop"] == $row["libelle_prop"]){
								echo '<option selected>';
							}
							else{
								echo '<option>';
							}
						echo $row["libelle_prop"].'</option>';
					}
				}
			?>
		</select>
		Prix:<select id="sel2" onchange="rubrique();">
		<?php
			$arr = array();
			$arr[] = '--';
			$arr[] = '10-50';
			$arr[] = '50-100';
			$arr[] = '100-500';
			$arr[] = '>500';
			
			foreach($arr as $item){
				if(isset($_GET["prix"]) && $_GET["prix"] == $item){
					echo '<option selected>';
				}
					else{
					 echo '<option>';
				}
				echo $item.'</option>';
			}
			?>
		</select>€
	  <hr>
      <section id="services" class="clear">
        <article class="one_third">
		<?php 
		$result = query($mysqli,'select * from produits');
		
		if(isset($_GET["rub"]) && $_GET["rub"] != 'Indice'){
			$result = query($mysqli,'select * from produits, appartient, rubrique where produits.id_prod = appartient.id_prod and rubrique.id_rub = appartient.id_rub and libelle_rub = \''.$_GET["rub"].'\'');
			if(isset($_GET["prop"]) && $_GET["prop"] != '--'){
					$result = query($mysqli,'select * from produits, appartient, rubrique,propriete,appartient2 where produits.id_prod = appartient.id_prod and rubrique.id_rub = appartient.id_rub and appartient2.id_prod = produits.id_prod and appartient2.id_prop = propriete.id_prop and libelle_prop = \''.$_GET["prop"].'\' and libelle_rub = \''.$_GET["rub"].'\'');
						if(isset($_GET["prix"]) && $_GET["prix"] != '--'){
							$p = array();
							$p[0] = '0';
							$p[1] = '50000';	
										if($_GET["prix"] != '10-50'){
											$p[0] = '10';
											$p[1] = '50';
										}
										else if($_GET["prix"] != '50-100'){
											$p[0] = '50';
											$p[1] = '100';											
										}else if($_GET["prix"] != '100-500'){
											$p[0] = '100';
											$p[1] = '500';											
										}
										else{
												$p[0] = '501';
												$p[1] = '50000';
										}
										$result = query($mysqli,'select * from produits, appartient, rubrique,propriete,appartient2 where produits.id_prod = appartient.id_prod and rubrique.id_rub = appartient.id_rub and appartient2.id_prod = produits.id_prod and appartient2.id_prop = propriete.id_prop and libelle_prop = \''.$_GET["prop"].'\' and libelle_rub = \''.$_GET["rub"].'\' and (Prix between '.$p[0].' and '.$p[1].')');
						}
			}else{
				if(isset($_GET["prix"]) && $_GET["prix"] != '--'){
							$p = array();
							$p[0] = '0';
							$p[1] = '50000';	
										if($_GET["prix"] != '10-50'){
											$p[0] = '10';
											$p[1] = '50';
										}
										else if($_GET["prix"] != '50-100'){
											$p[0] = '50';
											$p[1] = '100';											
										}else if($_GET["prix"] != '100-500'){
											$p[0] = '100';
											$p[1] = '500';											
										}
										else{
												$p[0] = '501';
												$p[1] = '50000';
										}
										$result = query($mysqli,'select * from produits, appartient, rubrique,propriete,appartient2 where produits.id_prod = appartient.id_prod and rubrique.id_rub = appartient.id_rub and appartient2.id_prod = produits.id_prod and appartient2.id_prop = propriete.id_prop and libelle_rub = \''.$_GET["rub"].'\' and (Prix between '.$p[0].' and '.$p[1].')');
						}
			}
		}
		else{
					if(isset($_GET["prop"]) && $_GET["prop"] != '--'){
					$result = query($mysqli,'select * from produits, appartient, rubrique,propriete,appartient2 where produits.id_prod = appartient.id_prod and rubrique.id_rub = appartient.id_rub and appartient2.id_prod = produits.id_prod and appartient2.id_prop = propriete.id_prop and libelle_prop = \''.$_GET["prop"].'\'');
						if(isset($_GET["prix"]) && $_GET["prix"] != '--'){
							$p = array();
							$p[0] = '0';
							$p[1] = '50000';	
										if($_GET["prix"] != '10-50'){
											$p[0] = '10';
											$p[1] = '50';
										}
										else if($_GET["prix"] != '50-100'){
											$p[0] = '50';
											$p[1] = '100';											
										}else if($_GET["prix"] != '100-500'){
											$p[0] = '100';
											$p[1] = '500';											
										}
										else{
												$p[0] = '501';
												$p[1] = '50000';
										}
										$result = query($mysqli,'select * from produits, appartient, rubrique,propriete,appartient2 where produits.id_prod = appartient.id_prod and rubrique.id_rub = appartient.id_rub and appartient2.id_prod = produits.id_prod and appartient2.id_prop = propriete.id_prop and libelle_prop = \''.$_GET["prop"].'\' and (Prix between '.$p[0].' and '.$p[1].')');
						}
					}else{
						if(isset($_GET["prix"]) && $_GET["prix"] != '--'){
							$p = array();
							$p[0] = '0';
							$p[1] = '50000';	
										if($_GET["prix"] != '10-50'){
											$p[0] = '10';
											$p[1] = '50';
										}
										else if($_GET["prix"] != '50-100'){
											$p[0] = '50';
											$p[1] = '100';											
										}else if($_GET["prix"] != '100-500'){
											$p[0] = '100';
											$p[1] = '500';											
										}else{
												$p[0] = '501';
												$p[1] = '50000';
										}
										$result = query($mysqli,'select * from produits, appartient, rubrique,propriete,appartient2 where produits.id_prod = appartient.id_prod and rubrique.id_rub = appartient.id_rub and appartient2.id_prod = produits.id_prod and appartient2.id_prop = propriete.id_prop and (Prix between '.$p[0].' and '.$p[1].')');
						}
					}
		}
		if((mysqli_num_rows($result)>0)){
				while($row = mysqli_fetch_assoc($result)){
					
				echo '<article class="one_third">
					  <figure><img src="images/'.$row["PHOTO"].'" width="300" alt="">
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
			echo '<p>pas de produits dans la base de données</p>';
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
