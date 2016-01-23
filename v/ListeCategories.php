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
        echo "<h1>Consulter les categories </h1>";
        echo "<BR/><BR/>";
					echo "<center><table align='center' border='2' >";
						echo "<tr><th>Id Categorie</th><th>Nom Categorie</th><th>Supprimer Categorie</th><th>Modifier Categorie</th></tr>";	
            $result = $conn -> prepare("Select * FROM Categorie");
            $result->execute();
						// affichage lignes du tableau 
						while($donnees = $result->fetch(PDO::FETCH_ASSOC)){
		          echo "<tr>";
              foreach($donnees as $attribut => $valeur) {
								echo "<td>".$valeur."</td>";
							}
              echo "<td><a href=\"../index.php?entite=categorie&action=D&id=$donnees[idCat]\"><img src=\"images/corbeille.png\" border=\"0\" /></a></td>";
              echo "<td><a href=\"ModifCategorie.php?idCat=$donnees[idCat]\"><img src=\"images/modifier.gif\" border=\"0\" /></a></td>";
							echo "</tr>";
          	}
	          $result->closeCursor();
					echo "</table></center>";	
					echo "<BR/><BR/>";		
          echo "<center><a href=\"ajoutCategorie.php\"><h2>Ajouter une categorie</h2></a></center>";	
			?>
		</section>
	</div>
	<?php include("./include/footer.php"); ?>
</body>
</html>