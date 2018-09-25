<div class="wrapper row1">
  <header id="header" class="clear">
    <div id="hgroup">
      <h1><a href="index.php">TaupeVelós</a></h1>
    </div>
    <nav>
      <ul>
        <li><a href="index.php">Accueil</a></li>
        <li><a href="produits.php">Produits</a></li>
		<?php
		if(isset($_SESSION["login"])){
			echo '<li><a href="deconnexion.php">Déconnexion</a></li>';
		}else{
			echo '<li><a href="connexion.php">Connéxion</a></li>';
		}
			
		?>
        <li class="last"><a href="panier.php">Panier</a></li>
      </ul>
	  <hr>
	  <ul>
	  <?php
	  
	  if(isset($_SESSION["login"]) && ($_SESSION["login"]) == 'admin'){
			echo '<li><a href="profil.php">Profil</a></li>';
			echo '<li><a href="administration.php">Administration</a></li>';
	  }else{
		  echo '<li><a href="profil.php">Profil</a></li>';
	  }
	  
	  
	  ?>
	  </ul>
    </nav>
  </header>
</div>