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
      
      <?php
        echo "<p>Recherche de produits :</p><BR/>";
        echo "<form method='post' >";
        echo "<p>";
        echo "mots-cle : <input type='text' name='mots' /> <BR/><BR/>";
        echo "<input type='submit' name='Envoyer' value='Valider' />";
        echo "</p>";
        echo "</form>";
        echo "</BR></BR>";
        
        if(isset($_POST['mots'])){
          $result = $conn -> prepare("SELECT idProd, idCat, nomProd, prixHTprod FROM Produit WHERE nomProd LIKE '%".$_POST['mots']."%'");
          $result->execute();
          echo "<table align='center' border='2' >";
						echo "<tr><th>Id Produit</th><th>Categorie Produit</th><th>Nom Produit</th><th>Prix Produit</th></tr>";	
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