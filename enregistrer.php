<?php
session_start();
include("Parametres.php");
include("Fonctions.inc.php");
include("Donnees.inc.php");
//permet de verifier la date
include("fonctions/Outils.php");

$mysqli=mysqli_connect($host.":".$port,$user,$pass) or die("Problème de création de la base :".mysqli_error());
mysqli_select_db($mysqli,$base) or die("Impossible de sélectionner la base : $base");


$ok = true;
$result["msg"] = "invalide";


		  if((isset($_POST["loginbdd"])) && (isset($_POST["passwordbdd"]))){			  
			  if(empty($_POST["loginbdd"]) || empty($_POST["passwordbdd"])){
				$return["pass"] = "le mot de passe est très court";
			    $return["loginVal"] = "le login n'est pas valide";
				$ok = false;
			  }
			  else{
				 $pass = mysqli_real_escape_string($mysqli,$_POST["passwordbdd"]);
				 $login = mysqli_real_escape_string($mysqli,$_POST["loginbdd"]);
				 $matches[] = NULL;
				 if(!preg_match("/^[a-zA-Z'\-\_0-9 ]+$/",$_POST["loginbdd"])){
							  $return["loginVal"] = "le login n'est pas valide";
							  $login = NULL;
							
					  }
					  
				  
				  if(sizeof($login)>100){
					  $return["loginLong"] = "le login est trop long";
					  $ok = false;
				  }
				  
				  if(sizeof($pass)>100){
					  $return["passLong"] = "le mot de passe est trop long";
					  $ok = false;
				  }
				  
			  }
			  
		  }
		  else{
			   $return["loginVal"] = "le login n'est pas valide";;
			   $return["passVal"] = "le mot de passe n'est valide";
			   $ok = false;
		  }
			
		  	if(isset($_POST["emailbdd"])){
				if(!filter_var($_POST["emailbdd"], FILTER_VALIDATE_EMAIL)){
					  $return["emailVal"] = "l'email n'est pas valide";
					  $email = NULL;
				}
				else{
					$email = $_POST["emailbdd"];
				}
			}else{
				$email = NULL;
			}
		  
		 if(isset($_POST["nombdd"])){
			  if(empty($_POST["nombdd"])){
				  $return["Nom"] = "le Nom n'est pas valide";
				  $nom = NULL;
			  }
			  else{
				  $nom = mysqli_real_escape_string($mysqli,$_POST["nombdd"]);
				  if(!preg_match("/^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ'\- ]+$/",$_POST["nombdd"])){
					  $return["Nom"] = "le Nom n'est pas valide";
					  $nom = NULL;
				  }else if(sizeof($nom)>50){
					  $return["Nom"] = "le Nom est trop long";
					   $ok = false;
				  }
			  } 
		  }else{
			  $nom = NULL;
		  }
		  
		  if(isset($_POST["prenombdd"])){
			  if(empty($_POST["prenombdd"])){
				  $prenom = NULL;
			  }
			  else{
				  $prenom = mysqli_real_escape_string($mysqli,$_POST["prenombdd"]);
				  if(!preg_match("/^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ'\- ]+$/",$_POST["prenombdd"])){
					  $return["Prenom"] = "le Prénom n'est pas valide";
					  $prenom = NULL;
				  }else if(sizeof($prenom)>50){
					  $return["Prenom"] = "le Prénom est trop long";
					   $ok = false;
				  }
			  } 
		  }
		  else{
			  $prenom = NULL;
		  }
		  
		  if(isset($_POST["adressebdd"])){
			  if(empty($_POST["adressebdd"])){
			  $adresse = NULL;
			}else{
				$adresse = mysqli_real_escape_string($mysqli,$_POST["adressebdd"]);
				if((strlen($adresse)>500) || (!preg_match("/^[0-9a-zA-Z'\- ]+$/",$_POST["adressebdd"]))){
				$return["Adresse"] = "L'adresse n'est pas valide";
				$ok = false;
				}
			}
		  }else{
			  $adresse = NULL;
		  }
		
		
		if(isset($_POST["villebdd"])){
			  if(empty($_POST["villebdd"])){
			  $ville = NULL;
			}else{
				$ville = mysqli_real_escape_string($mysqli,$_POST["villebdd"]);
				if((strlen($ville)>50) || (!preg_match("/^[a-zA-Z'\- ]+$/",$_POST["villebdd"]))){
				$return["ville"] = "La ville n'est pas valide";
				$ok = false;
				}
			}
		  }
		  else{
			  $ville = NULL;
		  }
		  
		//if(isset($_POST["codepostalbdd"])){
			if(empty($_POST["codepostalbdd"])){
			  $codepostal = NULL;
			  $return["codepostal"] = "le code postal n'est pas valide";
			  $ok = false;
			}else{
				$codepostal = mysqli_real_escape_string($mysqli,$_POST["codepostalbdd"]);
				if(!preg_match("/^([0-9]{5}$)/",$_POST["codepostalbdd"])){
				$return["codepostal"] = "le code postal n'est pas valide" ;
				$ok = false;
				}
			}
		  /*}else{
			  $codepostal = NULL;
			  $return["codepostal"] = "Veuillez renseigner le code postal" ;
			  $ok = false;
		  }*/
		
		if(isset($_POST["datebdd"])){
			 if(empty($_POST["datebdd"])){
			  $date = NULL;
			}else{
				$date = mysqli_real_escape_string($mysqli,$_POST["datebdd"]);
				$datebd = explode('-', $date);
				$temp = $datebd[0];
				$datebd[0] = $datebd[2];
				$datebd[2] = $temp;
				if((strlen($date) != 10) || (!checkdate($datebd[1], $datebd[0], $datebd[2])) || (!dateIsCorrect($datebd)))
				{
					$return["date"] = "la date n'est pas valide";
					$ok = false;
				}
			}
		}
		else{
			$date = NULL;
		}
		  
		 if(isset($_POST["telephonebdd"])){
			$telephoneVal = mysqli_real_escape_string($mysqli,$_POST["telephoneVal"]);
			if(!preg_match("/^0([0-9]{9}$)/",$_POST["telephonebdd"],$matches) && (strlen($telephoneVal)!=10)){
					  $return["telephoneVal"] = "le telephone n'est pas valide";
					  $telephone = NULL;
					  $ok = false;
			}
			else{
				$telephone = $_POST["telephonebdd"];
			}
		  }else{
			  $telephone = NULL;
		  }
		  	 
		  
		  
		  if(isset($_POST["optradio"])){
			  $sexe = $_POST["optradio"];
		  }else{
			  $sexe = NULL;
		  }
		//-------------------------------------------------------------------------------------  
		 if(isset($_POST["datebdd"]) && preg_match("/^[0-9\-\/ ]+$/",$_POST["datebdd"])){
			  $date = $_POST["datebdd"];
		 }else 
			 if(isset($_POST["datebdd"])){
					$data = explode("/",$_POST["datebdd"]);
					if(isset($data[1]) && isset($data[0]) && isset($data[2])){
							if(checkdate((int)$data[1],(int)$data[0],(int)$data[2])){
							  $date = trim(mysqli_real_escape_string($mysqli,$_POST["datebdd"])); 
						}
					}
					
				$date = NULL;
		}
		  if(isset($login)){
				  $str = "SELECT EMAIL FROM USERS WHERE login = '".$login."'";
			  $result = query($mysqli,$str) or die("Impossible de creer une compte dans ce moment<br>");
			  if(mysqli_num_rows($result)>0){
				  $ok = false;
				  $return["dejaEmail"] = "l'email saisi est déjà enregistré";
			  }
			  
			  
			  $str = "SELECT LOGIN FROM USERS WHERE LOGIN = '".$login."'";
			  $result = query($mysqli,$str) or die("Impossible de creer une compte dans ce moment<br>");
			  if(mysqli_num_rows($result)>0){
				  $ok = false;
				  $return["dejaLogin"] = "le login saisi est déjà enregistré";
			  }
		  }else{
			  $ok = false;
		  }




	if($ok == true){
				$str = "INSERT INTO USERS VALUES ('".$login."','".$email."','".password_hash($pass, PASSWORD_DEFAULT)."','".$nom."','".$prenom."','".$date."','".$sexe."','".$adresse."','".$codepostal."','".$ville."','".$telephone."');";
				query($mysqli,$str) or die("Impossible de creer une compte dans ce moment<br>");
				$_SESSION["login"] = $login;
			    $_SESSION["NOM"] = $nom;
				$_SESSION["PRENOM"] = $prenom;
				$_SESSION["ADRESSE"] = $adresse;
				$_SESSION["CP"] = $codepostal;
				$_SESSION["VILLE"] = $ville;
				$_SESSION["TELEPHONE"] = $telephone;
				unset($return);
				mysqli_close($mysqli);	
				header('location: profil.php');
	}
	
mysqli_close($mysqli);
$_SESSION["inscription"] = $return;
header('location: inscription.php');
?>
