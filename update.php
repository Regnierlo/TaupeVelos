<?php
	session_start();

	include("Parametres.php");
	include("Fonctions.inc.php");
	include("Donnees.inc.php");
	include("fonctions/Outils.php");

	$mysqli=mysqli_connect($host.":".$port,$user,$pass) or die("Problème de création de la base :".mysqli_error());
	mysqli_select_db($mysqli,$base) or die("Impossible de sélectionner la base : $base");

	$str = "SELECT * FROM USERS WHERE LOGIN = '".$_SESSION["login"]."'";
	$result = query($mysqli,$str) or die ("Impossible de faire une connection à base de donnèes<br>");
	$row = mysqli_fetch_assoc($result);
	if((isset($_POST["emailbdd"]) && empty($_POST["emailbdd"])) || !(isset($_POST["emailbdd"]))){
		$email = $row["EMAIL"];
	}
	else{
		if(trim(mysqli_real_escape_string($mysqli,$_POST["emailbdd"]))>100){
			$email = $row["EMAIL"];
		}else if(!filter_var(trim(mysqli_real_escape_string($mysqli,$_POST["emailbdd"])), FILTER_VALIDATE_EMAIL)){
			$email = $row["EMAIL"];
		}else{
			$email = trim(mysqli_real_escape_string($mysqli,$_POST["emailbdd"]));
		}
	}

	if((isset($_POST["passwordbdd"]) && empty($_POST["passwordbdd"])) || !(isset($_POST["passwordbdd"]))){
		$pass = $row["PASS"];
	}
	else{
		if(trim(mysqli_real_escape_string($mysqli,$_POST["passwordbdd"]))>200){
			$pass = $row["PASS"];
		}else{
			$pass = trim(mysqli_real_escape_string($mysqli,$_POST["passwordbdd"]));
		}

	}

	if((isset($_POST["nombdd"]) && empty($_POST["nombdd"])) || !(isset($_POST["nombdd"]))){
		$nom = $row["NOM"];
	}
	else{
		if(!preg_match("/^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ'\- ]+$/",$_POST["nombdd"])){
			$prenom = $row["NOM"];
		}
		else if(trim(mysqli_real_escape_string($mysqli,$_POST["nombdd"]))>50){
			$prenom = $row["NOM"];
		}
		else{
			$nom = trim(mysqli_real_escape_string($mysqli,($_POST["nombdd"])));
		}

	}

	if((isset($_POST["prenombdd"]) && empty($_POST["prenombdd"])) || !(isset($_POST["prenombdd"]))){
		$prenom = $row["PRENOM"];
	}
	else{
		if(!preg_match("/^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ'\- ]+$/",$_POST["prenombdd"])){
			$prenom = $row["PRENOM"];
		}
		else if(trim(mysqli_real_escape_string($mysqli,$_POST["prenombdd"]))>50){
			$prenom = $row["PRENOM"];
		}
		else{
			$prenom = trim(mysqli_real_escape_string($mysqli,$_POST["prenombdd"]));
		}

	}

	if((isset($_POST["adressebdd"]) && empty($_POST["adressebdd"])) || !(isset($_POST["adressebdd"]))){
		$adresse = $row["ADRESSE"];
	}
	else{
		if(!preg_match("/^[0-9a-zA-Z'\- ]+$/",$_POST["adressebdd"])){
			$adresse = $row["ADRESSE"];
		}
		else if(strlen(mysqli_real_escape_string($mysqli,$_POST["adressebdd"]))<=500){
			$adresse = $_POST["adressebdd"];
			$msgEdit.="Edition de l'adresse impossible.";
		}
		else{
			$adresse = $row["ADRESSE"];
		}
	}

	if((isset($_POST["villebdd"]) && empty($_POST["villebdd"])) || !(isset($_POST["villebdd"]))){
		$ville = $row["VILLE"];
	}
	else{
		if(!preg_match("/^[a-zA-Z'\- ]+$/",$_POST["villebdd"])){
			$ville = $row["VILLE"];
		}
		else if(trim(mysqli_real_escape_string($mysqli,$_POST["villebdd"]))>50){
			$ville = $row["VILLE"];
		}
		else{
			$ville = trim(mysqli_real_escape_string($mysqli,$_POST["villebdd"]));
		}
	}

	if((isset($_POST["postalbdd"]) && empty($_POST["postalbdd"])) || !(isset($_POST["postalbdd"]))){
		$codepostal = $row["CODEP"];
	}
	else{
		if(!preg_match("/^[0-9\- ]+/",$_POST["postalbdd"])){
			$codepostal = $row["CODEP"];
		}
		else if(strlen(trim(mysqli_real_escape_string($mysqli,$_POST["postalbdd"])))<5){
			$codepostal = $row["CODEP"];
		}
		else{
			$codepostal = trim(mysqli_real_escape_string($mysqli,$_POST["postalbdd"]));
		}
	}

	if((isset($_POST["datebdd"]) && empty($_POST["datebdd"])) || !(isset($_POST["datebdd"]))){

		$date = $row["DATE"];
	}
	else{
		$len = strlen(trim(mysqli_real_escape_string($mysqli,$_POST["datebdd"])));

		if($len>10){
			$date = $row["DATE"];
		}
		else{
			$date = mysqli_real_escape_string($mysqli,$_POST["datebdd"]);
			$datebd = explode('-', $date);
			$temp = $datebd[0];
			$datebd[0] = $datebd[2];
			$datebd[2] = $temp;
			if(!((strlen($date) != 10) || (!checkdate($datebd[1], $datebd[0], $datebd[2])) || (!dateIsCorrect($datebd))))
			{
				$date = trim(mysqli_real_escape_string($mysqli,$_POST["datebdd"]));
			}
			else {
				$date = $row["DATE"];
			}
		}
	}

	if((isset($_POST["telephonebdd"]) && empty($_POST["telephonebdd"])) || !(isset($_POST["telephonebdd"]))){
		$telephone = $row["TELEPHONE"];
	}
	else{
		//$len = strlen(trim(mysqli_real_escape_string($mysqli,$_POST["telephonebdd"])));
		$newTel = str_replace(' ', '', $_POST["telephonebdd"]);
		$len = strlen($newTel);

		if(!preg_match("/^[0-9\- ]+$/",$_POST["telephonebdd"])){
			$telephone = $row["TELEPHONE"];
		}
		else if($len>10){
			$telephone = $row["TELEPHONE"];
			var_dump(trim(mysqli_real_escape_string($mysqli,$_POST["telephonebdd"]))." : ".$len);
			exit();
		}
		else{
			$telephone = $newTel;
		}
	}

	$sexe = $_POST["optradio"];

	$str = "UPDATE USERS SET EMAIL = '".$email."', PASS = '".password_hash($pass, PASSWORD_DEFAULT)."', NOM ='".$nom."', PRENOM = '".$prenom."', ADRESSE = '".$adresse."', CODEP = '".$codepostal."', VILLE = '".$ville."', DATE = '".$date."',SEXE = '".$sexe."', TELEPHONE = '".$telephone."' WHERE LOGIN = '".$_SESSION["login"]."'";

	query($mysqli,$str) or die ("Impossible de se connecter à base de donnèes<br>");
	header('location: profil.php');
?>
