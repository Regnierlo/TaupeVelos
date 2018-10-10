<?php
session_start();
								include("../Parametres.php");
								include("../Fonctions.inc.php");
								include("../Donnees.inc.php");
									  
								 $mysqli=mysqli_connect($host.":".$port,$user,$pass) or die("Problème de création de la base :".mysqli_error());
								 mysqli_select_db($mysqli,$base) or die("Impossible de sélectionner la base : $base");
										//$return["msg"] = "L'utilisateur n'a été pas trouvé";
										
										//Condition sur les contenus des champs pass et login pas utile car on utilise une requète bdd pour tester si les valeurs corespondent à un utilisateur inscrit

										//if(isset($_POST["login"]) && isset($_POST["password"])){


										  	$login = trim(mysqli_real_escape_string($mysqli,$_POST["login"]));
										  	$pass = $_POST["password"];
										  	$str = "SELECT LOGIN,PASS,EMAIL FROM USERS WHERE LOGIN = '".$login."'";
											$result = query($mysqli,$str) or die ("Impossible de se connection à la base de données<br>");
											if(mysqli_num_rows($result)>0){
												$row = mysqli_fetch_assoc($result);
													if(password_verify($pass, $row["PASS"])){
														/*
														Les erreurs concernaient la lecture des données :civilité nom prenonms adresse cp ville et telephone alors que lorsqu'on appelle la fonction on ne met que le login et le mdp dans $_session. Je n'ai pas trouvé d'utilité à ces lignes (à part l'affichage d'erreur lors de la connexion).


														*/
														$_SESSION["login"] = $row["LOGIN"];
														//$_SESSION["CIVILITE"] = $row["CIVILITE"];
														//$_SESSION["NOM"] = $row["NOM"];
														//$_SESSION["PRENOM"] = $row["PRENOM"];
														//$_SESSION["ADRESSE"] = $row["ADRESSE"];
														//$_SESSION["CP"] = $row["CP"];
														//$_SESSION["VILLE"] = $row["VILLE"];
														//$_SESSION["TELEPHONE"] = $row["TELEPHONE"];
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

										// Test sur le contenu des champs login et mdp inutile car on test directement on comparant à la bdd
										//} 
										// else
										// {
										// 	$return["msg"] = "Veuillez vous authentifier avec votre mot de passe et votre identifiant";
										// }
											
								mysqli_close($mysqli);
								echo $return["msg"];		
?>