<?php
  session_start();
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
        echo "<h1>Consulter les produits </h1>";
        echo "<BR/><BR/>";
					echo "<center><table align='center' border='2' >";
						echo "<tr><th>Id Produit</th><th>Nom Produit</th><th>Image Produit</th><th>Supprimer Produit</th><th>Modifier Produit</th></tr>";	
            $result = $conn -> prepare("Select idProd, nomProd, imageProd FROM Produit");
            $result->execute();
						// affichage lignes du tableau 
						while($donnees = $result->fetch(PDO::FETCH_ASSOC)){
		          echo "<tr>";
              echo "<td>".$donnees['idProd']."</td>";
              echo "<td>".$donnees['nomProd']."</td>";
              echo "<td><a href=\"DetailProduit.php?idProd=$donnees[idProd]\"><img src=\"images/produits/".$donnees['imageProd']."\" border=\"0\" /></a></td>";
              echo "<td><a href=\"SupprProduit.php?idProd=$donnees[idProd]\"><img src=\"images/corbeille.png\" border=\"0\" /></a></td>";
              echo "<td><a href=\"ModifProduit.php?idProd=$donnees[idProd]\"><img src=\"images/modifier.gif\" border=\"0\" /></a></td>";
							echo "</tr>";
          	}
	          $result->closeCursor();
					echo "</table></center>";	
					echo "<BR/><BR/>";		
          echo "<center><a href=\"AjouterProduit.php\"><h2>Ajouter un produit</h2></a></center>";	
			?>
		</section>
	</div>
	<?php include("./include/footer.php"); ?>
</body>
</html>