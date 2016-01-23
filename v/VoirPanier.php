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
        echo "<h1>Consulter le panier </h1>";
        echo "<BR/><BR/>";
        if(isset($_COOKIE['panier'])){
					echo "<center><table align='center' border='2' >";
						echo "<tr><th>Nom Produit</th><th>Image Produit</th><th>Prix Produit</th><th>Quantite</th><th>Supprimer</th></tr>";	
            foreach($_COOKIE['panier'] as $prod => $qte){
              $result = $conn -> prepare("Select nomProd, imageProd, prixHTprod, prixHTpromoPro, estPromoProd FROM Produit WHERE idProd = ?");
              $result->execute(array($prod));
  						// affichage lignes du tableau 
  						while($donnees = $result->fetch(PDO::FETCH_ASSOC)){
  		          echo "<tr>";
                echo "<td>".$donnees['nomProd']."</td>";
                echo "<td><a><img src=\"images/produits/".$donnees['imageProd']."\" border=\"0\" /></a></td>";
                if($donnees['estPromoProd'] == 1){
                  echo "<td><s>".$donnees['prixHTprod']."</s>  <b>".$donnees['prixHTpromoPro']."</b></td>";
                } else {
                  echo "<td>".$donnees['prixHTprod']."</td>";
                }
                echo "<td><form method='post' action='ModifierPanier.php'><input type='number' name='$prod' step='1' value='$qte' min='1' max='999'/><input type='hidden' name='idProd' value='$prod'><input type='submit' name='Envoyer' value='ok' /></form></td>";
                echo "<td><form method='post' action='ModifierPanier.php'><input type='submit' name='Envoyer' value='Delete' /><input type='hidden' name='idProd' value='$prod'></form></td>";
  							echo "</tr>";
            	}
  	          $result->closeCursor();
             }

					echo "</table></center>";	
					echo "<BR/><BR/>";		
          echo "<center><a href=\"ValiderPanier.php\"><h2>Valider le panier</h2></a></center>";
          } else {
            echo "<p> Le panier est vide ! </p>";
          }
			?>
		</section>
	</div>
	<?php include("./include/footer.php"); ?>
</body>
</html>