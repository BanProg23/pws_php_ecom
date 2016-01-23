<nav class="sidebar">
  <ul>
    <li><a href="index.php">Accueil</a></li>
    <li><a href="ListeCategories.php">Gestion categories</a></li>
    <li><a href="ListeProduit.php">Gestion produits</a></li>
    <li><a href="AffichageBase.php">Affichage Base</a></li>
    <li><a href="RazBase.php">TABLE RASE</a></li>
    <li><a href="deconnexion.php">Deconnexion</a></li>
	<?php
	// si le cookie est présent alors on affiche un hyperlien pour aller vers la page DetruireCookie.php
	// Rappel : pour détruire un cookie, il faut le renvoyer avec une date d'expiration "dans le passé"
 
    if(isset($_COOKIE['cookIdent'])) {
      echo '<li><a href="DetruireCookie.php">D�truire le cookie</a></li>';
    }	
	?>
	
  </ul>
</nav>
