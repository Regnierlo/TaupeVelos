<?php
session_start();
								include("../Parametres.php");
								include("../Fonctions.inc.php");
								include("../Donnees.inc.php");
								 $mysqli=mysqli_connect($host.":".$port,$user,$pass) or die("Problème de création de la base :".mysqli_error());
								 mysqli_select_db($mysqli,$base) or die("Impossible de sélectionner la base : $base");
										  	$login = trim(mysqli_real_escape_string($mysqli,$_POST["login"]));
										  	$pass = $_POST["password"];
										  	$str = "SELECT LOGIN,PASS,EMAIL,NOM,PRENOM,ADRESSE,CODEP,VILLE,TELEPHONE,SEXE FROM USERS WHERE LOGIN = '".$login."'";
											$result = query($mysqli,$str) or die ("Impossible de se connection à la base de données<br>");
											if(mysqli_num_rows($result)>0){
												$row = mysqli_fetch_assoc($result);
													if(password_verify($pass, $row["PASS"])){
														$_SESSION["login"] = $row["LOGIN"];
														$_SESSION["CIVILITE"] = $row["SEXE"];
														$_SESSION["NOM"] = $row["NOM"];
														$_SESSION["PRENOM"] = $row["PRENOM"];
														$_SESSION["ADRESSE"] = $row["ADRESSE"];
														$_SESSION["CP"] = $row["CODEP"];
														$_SESSION["VILLE"] = $row["VILLE"];
														$_SESSION["TELEPHONE"] = $row["TELEPHONE"];
														unset($return);
														$return["msg"] = "L'utilisateur est connecté";
														mysqli_close($mysqli);
														echo $return["msg"];
														exit();
													}
													else
													{
														$return["msg"] = "Login ou mot de passe incorrect";
													}

											}
											else
											{
												$return["msg"] = "Login ou mot de passe incorrect";
											}
								mysqli_close($mysqli);
								echo $return["msg"];
?>
