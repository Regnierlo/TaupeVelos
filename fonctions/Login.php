<?php
session_start();
								include("../Parametres.php");
								include("../Fonctions.inc.php");
								include("../Donnees.inc.php");
									  
								 $mysqli=mysqli_connect($host.":".$port,$user,$pass) or die("Problème de création de la base :".mysqli_error());
								 mysqli_select_db($mysqli,$base) or die("Impossible de sélectionner la base : $base");
										//$return["msg"] = "L'utilisateur n'a été pas trouvé";
										
										if(isset($_POST["login"]) && isset($_POST["password"])){
										  $login = trim(mysqli_real_escape_string($mysqli,$_POST["login"]));
										  $pass = $_POST["password"];
										  $str = "SELECT LOGIN,PASS,EMAIL FROM USERS WHERE LOGIN = '".$login."'";
										  $result = query($mysqli,$str) or die ("Impossible de se connection à la base de données<br>");
											  if(mysqli_num_rows($result)>0){
													$row = mysqli_fetch_assoc($result);
													if(password_verify($pass, $row["PASS"])){
														$_SESSION["login"] = $row["LOGIN"];
														$_SESSION["CIVILITE"] = $row["CIVILITE"];
														$_SESSION["NOM"] = $row["NOM"];
														$_SESSION["PRENOM"] = $row["PRENOM"];
														$_SESSION["ADRESSE"] = $row["ADRESSE"];
														$_SESSION["CP"] = $row["CP"];
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
														$return["msg"] = "Utilisateur pas connecté";
													}
													
											  }
										}
										else
										{
											$return["msg"] = "FONCTIONNE PAS";
										}
								mysqli_close($mysqli);
								echo $return["msg"];		
?>