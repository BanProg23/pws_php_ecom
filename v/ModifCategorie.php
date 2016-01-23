<?php
	// si la session n'est pas enregistré alor on n'a pas le droit d'être dans l'espace sécurisé
	// donc le script renvoie vers l'index
	if (!isset($_SESSION['identifie'])) {
		header('location:index.php');
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
		include("./include/header.php"); 
    require_once("connect.inc.php");
	?>
	<div class="wrapper">
		<?php include("./include/menusA.php"); ?>
		<section id="content">
			<?php	
        echo "<h1>Modifier une categorie</h1>";
        echo "<BR/><BR/>";
            $result = $conn -> prepare("SELECT nomCat FROM Categorie WHERE idCat = ?");
            $result->execute(array($_GET["idCat"]));
            $donnees = $result->fetch(PDO::FETCH_ASSOC);
            
        echo "<form method='post'>";
        echo "Nom de la categorie : <input type='text' name='name' value=\"$donnees[nomCat]\">    ";
        echo "<input type='submit' name='submit' value='Valider'>";
        echo "</form>";
        
        $result->closeCursor();
        
					echo "<BR/><BR/>";			
          
          if(isset($_POST['name'])) {
            if(!empty($_POST['name'])) {    
              $result = $conn -> prepare("UPDATE Categorie SET nomCat = ? WHERE idCat = ?");
              $result->execute(array($_POST["name"], $_GET["idCat"]));
              header('location:ListeCategories.php');
            }
          }	
			?>
		</section>
	</div>
	<?php include("./include/footer.php"); ?>
</body>
</html>