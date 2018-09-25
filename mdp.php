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
				$("#valider").click(function(){
				$.ajax({
					   url: "fonctions/mdp.php",
					   method: "POST",
					   data: {email : $("#email").val()},
					   success: function(data)
							{
								alert(data);
								history.back();
							}
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
					<h2>Mot de passe oublié</h2><br/>
					<label>Entrez l'adresse email avec laquelle vous vous êtes inscrit pour réinitialiser votre mot de passe.</label><br/><br/>
					<input type="text" size="55" id="email" placeholder="votre email"></input><br/><br/>
					<button id="valider">Valider</button>
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
