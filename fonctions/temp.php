	<?	include("Parametres.php");
		include("Fonctions.inc.php");
		$mysqli=mysqli_connect($host.":".$port,$user,$pass) or die("Problème de création de la base :".mysqli_error());
		mysqli_select_db($mysqli,$base) or die("Impossible de sélectionner la base : $base");
		$result = query($mysqli,'select * from produits order by id_prod desc limit 1');
		
		if((mysqli_num_rows($result)>0)){
		$row = mysqli_fetch_assoc($mysqli,$result);
		
		
		
		}
		else{
		
		
		
		}
		
		mysqli_close($mysqli);
		?>