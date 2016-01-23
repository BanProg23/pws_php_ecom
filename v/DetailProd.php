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
        <h1>Detail Produit</h1>
        <BR/><BR/>
        <?php
              echo "<center><table align='center' border='2' >";
  						echo "<tr>";
              echo"<th>Categorie</th><th>Nom</th><th>Details</th><th>Image</th><th>Poids</th><th>Disponibilite</th><th>Delai de livraison</th><th>Prix</th><th>Taux TVA</th>";
              echo "</tr>";
                $result = $conn -> prepare("SELECT * FROM Produit WHERE idProd = ?");
                $result->execute(array($_GET["idProd"]));
                $donnees = $result->fetch(PDO::FETCH_ASSOC);
		              echo "<tr>";
                  $result2 = $conn -> prepare("SELECT nomCat FROM Categorie WHERE idCat = ?");
                  $result2->execute(array($donnees["idCat"]));
                  $donnees2 = $result2->fetch(PDO::FETCH_ASSOC);
                  echo "<td>".$donnees2['nomCat']."</td>";
                  $result2->closeCursor();
                  echo "<td>".$donnees['nomProd']."</td>";
                  echo "<td>".$donnees['detailProd']."</td>";
                  echo "<td><img src=\"images/produits/".$donnees['imageProd']."\" border=\"0\" /></td>";
                  echo "<td>".$donnees['poidsProd']."</td>";
                  if($donnees['estDispoProd'] == 1){
                    echo "<td>Oui</td>";
                  } else {
                    echo "<td>Non</td>";
                  }
                  echo "<td>".$donnees['delaiProd']."</td>";
                  if($donnees['estPromoProd'] == 1){
                    echo "<td><s>".$donnees['prixHTprod']."</s>  <b>".$donnees['prixHTpromoPro']."</b></td>";
                  } else {
                    echo "<td>".$donnees['prixHTprod']."</td>";
                  }
                  echo "<td>".$donnees['tauxTVAprod']."</td>";
                  echo "<td><a href=\"AjouterPanier.php?idProd=$_GET[idProd]\"><img src=\"images/panier.png\" border=\"0\" /></a></td>";
                  echo"</tr>";
              echo "</table></center>";
              if($donnees['estNouveauProd'] == 1){
                echo"<img src=\"images/new.jpg\" border=\"0\" />";
              }
              if($donnees['estPromoProd'] == 1){
                echo"<img src=\"images/promotion.png\" border=\"0\" />";
              }
              if($donnees['estSelectProd'] == 1){
                echo"<img src=\"images/selection.png\" border=\"0\" />";
              }
              $result->closeCursor();
              echo "<BR/><BR/>";
              
			?>
		</section>
	</div>
	<?php include("./include/footer.php"); ?>
</body>
</html>