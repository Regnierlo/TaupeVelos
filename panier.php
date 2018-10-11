<!DOCTYPE html>
<?php
session_start();
include 'fonctions/acheter.php';
?>
<html lang="fr" dir="ltr">
<head>
<title>TaupeVélos</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="styles/layout.css" type="text/css">
<script src="js/jquery.min.js"></script>
<script>

			function removePanier(e){
				$.ajax({
					type: 'POST',
					url: 'fonctions/remove.php',
					data: {item : e},
					success: function(data){
								alert(data);
								location.reload();
					},
				});
			};
</script>
<!--[if lt IE 9]><script src="scripts/html5shiv.js"></script><![endif]-->
</head>
<body>

<?php include 'navbar.php';?>

<!-- content -->
<div class="wrapper row2">
  <div id="container" class="clear">
    <!-- main content -->
    <div id="main_content" style="min-height:400px">
	<h4>Panier</h4>
	<?php afficherPanier();	?>
	<div id="reponse"></div>
      <!-- / Introduction -->
    </div>
	<div>
	<?php
		if(isset($_SESSION["login"]) && isset($_COOKIE["panier"])){
					echo '<a href="paiement.php">ACHETER</a>';
		}else if(isset($_COOKIE["panier"])){
						echo '<p>Connectez vous pour pouvoir acheter</p>';
					}
	?>
	</div>
    <!-- / content body -->
  </div>
</div>
<!-- Footer -->
<!-- Copyright -->
<?php include 'foot.php';?>
</body>
</html>
