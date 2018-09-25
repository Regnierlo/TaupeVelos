<!DOCTYPE html>
<?php
session_start();
include 'fonctions/gproduits.php';
?>
<html lang="fr" dir="ltr">
<head>
<title>TaupeVélos</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="styles/layout.css" type="text/css">
<!--[if lt IE 9]><script src="scripts/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
		</noscript>
<script>
				function removeProd(e){
				$.ajax({
					type: 'POST',
					url: 'fonctions/removeProd.php',
					data: {item : e},
					success: function(data){
								location.reload();
								alert(data);					
					},
				});
			};
</script>
</head>
<body>

<?php include 'navbar.php';?>

<!-- content -->
<div class="wrapper row2">
  <div id="container" class="clear">
    <!-- main content -->
    <div id="homepage" style="min-height:400px">
	<?php afficherProduits(); ?>
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
