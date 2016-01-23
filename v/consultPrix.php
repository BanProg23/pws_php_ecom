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
				ConsultPrix.php	
			*********************/
				// le formulaire de choix de la tranche de prix
				echo "<h1>Consulter les produits par tranche de prix </h1>";
				echo "<BR/><BR/>";
				echo "<form method='post'>";
					echo "<fieldset>";
						echo "<legend> Produits </legend><BR/>";	
						echo "<input type='radio' name='choix' value='moins500' checked='checked'";
							// on garde la sélection effectuée précédemment
							if(isset($_POST['Afficher']) && isset($_POST['choix']) && $_POST['choix'] == "moins500") {echo "checked='checked'";}
						echo "/> Prix inférieur à 500€<BR/><BR/>";
						echo "<input type='radio' name='choix' value='plus500' ";
							if(isset($_POST['Afficher']) && isset($_POST['choix']) && $_POST['choix'] == "plus500") {echo "checked='checked'";}
						echo "/> Prix supérieur ou égal à 500€<BR/><BR/>";					
						echo "<input type='submit' name='Afficher' value='Afficher'/><BR/><BR/>";
					echo "</fieldset>";
				echo "</form>";		
								
				// le formulaire a été soumis
				if(isset($_POST['Afficher']) && isset($_POST['choix'])) {
					//  on sélectionne les produits recherchés					
					switch($_POST['choix']) { 
						case "moins500": 
                             
							$titre="Produits de prix inférieur à 500€";
							// on recherche les produits de -500€
              $result = $conn -> prepare("Select idProd, idCat, nomProd, prixHTprod FROM Produit Where prixHTprod < :pPrixProduit");
	            $result->execute(array('pPrixProduit' => 500));
							break;		
						case "plus500": 
              // on recherche les produits de +500€
							$titre="Produits de prix supérieur à 500€";
							$result = $conn -> prepare("Select idProd, idCat, nomProd, prixHTprod FROM Produit Where prixHTprod >= :pPrixProduit");
	            $result->execute(array('pPrixProduit' => 500));
							break;		
					}
					
					// on affiche le tableau des résultats
					echo "<BR/><BR/>";
					echo "<table align='center' border='2' >";
						echo "<caption>".$titre."</caption>";
						echo "<tr><th>Id Produit</th><th>Categorie Produit</th><th>Nom Produit</th><th>Prix Produit</th></tr>";	
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

















