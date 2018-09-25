<!DOCTYPE html>
<?php
session_start();
include 'fonctions/index.php';
include 'fonctions/ajouterProd.php';

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
    <div id="homepage" style="min-height:400px">
	<?php ajouterProduit(); ?>
      <!-- / Introduction -->
	 <?php 
		if(isset($_SESSION["produit"])){
			echo '<p><strong>'.$_SESSION["produit"].'</strong><p>';
		}
		unset($_SESSION["produit"]);
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
