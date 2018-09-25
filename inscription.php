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
</head>
<body>

<?php include 'navbar.php';?>

<!-- content -->
<div class="wrapper row2">
  <div id="container" class="clear">
    <!-- main content -->
    <div id="homepage" style="min-height:400px">
	<div class="modal-dialog">
			<div class = "modal-content">
				<div class="modal-header">
					<h4>Créer un compte</h4>
				</div>
				<div class="modal-body">
					<form method="post" action="enregistrer.php" autocomplete="off">
						<div>
							<input type="text" placeholder="Login" maxlength="100" name="loginbdd" />
						</div>
						<div>
							<input type="email" placeholder="Email" maxlength="200" name="emailbdd"/>
						</div>
						<div>
							<input type="password" placeholder="Password" maxlength="100" name="passwordbdd"/>
						</div>
						<div>
							<input type='text' placeholder='Nom' maxlength='200' name='nombdd'/>
						</div>
						<div>
							<input type='text' placeholder='Prénom' maxlength='100' name='prenombdd' />
						</div>
						<div>
							<input type='date' name='datebdd' placeholder='Date de Naissance' id='datePicker'/>
							<span class='input-group-addon add-on'><span class='glyphicon glyphicon-calendar'></span></span>
						</div>
						<div>
							<input type='text' placeholder='Telephone' maxlength='15' name='telephonebdd'/>
						</div>
						<div>
							<input type='textarea' placeholder='Adresse' maxlength='500' name='adressebdd'/>
						</div>
						<div>
							<input type='textarea' placeholder='Ville' maxlength='100' name='villebdd'/>
						</div>
						<div>
							<input type='textarea' placeholder='Code Postal' maxlength='50' name='codepostalbdd'/>
						</div>
						<div>
							<label class='radio-inline active'><input type='radio' name='optradio' checked='' value='Homme'/>Homme</label>
							<label class='radio-inline'><input type='radio' name='optradio' value='Femme'/>Femme</label>
						</div>
						<div>
							<input type="submit" value="valider">
						</div>
						<div>
						<?php
							echo '<ul>';
							if(isset($_SESSION["inscription"])){
								$arr = $_SESSION["inscription"];
								foreach($arr as $item){
									echo '<li>'.$item.'</li>';
								}
							}
							echo '</ul>';
							unset($_SESSION["inscription"]);
						?>
						</div>
					</div>					
				</div>
				</form>
			</div>
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
