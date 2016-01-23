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
		<?php include("./include/menus.php"); ?>
		<section id="content">
			<p>Bienvenue sur mon site !</p>
			<BR/>
			<?php	
			/********************
				ConsultCategorie.php	
			*********************/
				// le formulaire de saisie de la catégorie recherchée
				echo "<h1>Consulter les produits par catégorie </h1>";
				echo "<BR/><BR/>";
				echo "<form method='post'>";
					echo "<fieldset>";
						echo "<legend> Catégories </legend><BR/>";	
						echo "<select name='categories'>";
            $result = $conn -> prepare("Select idCat, nomCat FROM Categorie");
            $result->execute();
            while($donnees = $result->fetch(PDO::FETCH_ASSOC)){
				      echo "<option value='".$donnees['idCat']."'>".$donnees['nomCat']."</option>";	
            }
            $result->closeCursor();
						echo "</select><br/><br/>";			
						echo "<input type='submit' name='Afficher' value='Afficher'/>";
						echo "<br/><br/>";
					echo "</fieldset>";
				echo "</form>";		
				
			
				// le formulaire a été soumis
				if(isset($_POST['Afficher']) && isset($_POST['categories'])) {	
					// on affiche le tableau des résultats
					echo "<BR/><BR/>";
					echo "<table align='center' border='2' >";
						echo "<caption>".$donnees[$_POST['categories']]."</caption>";
						echo "<tr><th>Id Produit</th><th>Categorie Produit</th><th>Nom Produit</th><th>Prix Produit</th></tr>";	
            $result = $conn -> prepare("Select idProd, idCat, nomProd, prixHTprod FROM Produit Where idCat = :pIdCategorie");
            $result->execute(array('pIdCategorie' => $_POST['categories']));
						// affichage lignes du tableau 
						while($donnees = $result->fetch(PDO::FETCH_ASSOC)){
		          echo "<tr>";
              foreach($donnees as $attribut => $valeur) {
								echo "<td>".$valeur."</td>";
							}
              echo "<td><a href=\"DetailProd.php?idProd=$donnees[idProd]\"><u>Details</u></a></td>";
							echo "</tr>";
          	}
	          $result->closeCursor();
					echo "</table>";	
					echo "<BR/><BR/>";
				}				
			?>
		</section>
	</div>
	<?php include("./include/footer.php"); ?>
</body>
</html>

















