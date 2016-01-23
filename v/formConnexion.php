<?php
// si un cookie est existant on redirige vers traitConnexion.php sans passer par le formulaire d'identification
    if(isset($_COOKIE['cookIdent'])) {
      header('Location: index.php');
    }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="./include/styles.css" />
	<title>Mon site !</title>
</head>
<body>
	<?php

		if (isset($_GET['msgErreur'])) {
			echo "<h2>".$_GET['msgErreur']."</h2><BR/>";
		}
		echo "<p>Veuillez entrer les identifiants :</p><BR/>";
		echo "<form method='post' action='TraitConnexion.php'>";
		echo "<p>";
		echo "Login : <input type='text' value='admin' name='login' /> <BR/><BR/>";
		echo "Mot de passe : <input type='password' value='admin' name='motPasse' /><BR/><BR/>";
		echo "Se souvenir de moi : <input type='checkbox' name='cb_souvenirMoi' /><BR/><BR/>";
		echo "<input type='submit' name='Envoyer' value='Valider' />";
		echo "</p>";
		echo "</form>";
	?>
</body>
</html>
