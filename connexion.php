<!DOCTYPE html>
<?php include 'fonctions/connexion.php';?>
<html lang="fr" dir="ltr">
<head>
<title>TaupeVélos</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="styles/layout.css" type="text/css">
<script src="js/jquery.min.js"></script>
<script>
	$().ready(function() {
				$('#submit').click(function (){
				$.ajax({
					type: 'POST',
					url: 'fonctions/Login.php',
					data: {login : $('#login').val(), password : $('#password').val()},
					success: function(data){
								alert(data);
								location.href = 'index.php';				
					},
				});
			});
	});
</script>
<!--[if lt IE 9]><script src="scripts/html5shiv.js"></script><![endif]-->
</head>
<body>

<?php include 'navbar.php';?>

<!-- content -->
<div class="wrapper row2">
  <div id="container" class="clear">
    <!-- main content -->
    <div id="homepage" style="min-height:400px">
	<?php afficherConnexion();	?>
	<div id="reponse"></div>
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
