<?php
	// si la session n'est pas enregistré alor on n'a pas le droit d'être dans l'espace sécurisé
	// donc le script renvoie vers l'index
	if (!isset($_SESSION['identifie'])) {
		header('location:index.php');
	}
  
  header('location:ListeCategories.php');