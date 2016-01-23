<?php
  require_once("connect.inc.php");
  $today = getdate();
  $date = "$today[year]-$today[mon]-$today[mday]";
  $prix = 0;
  foreach($_COOKIE['panier'] as $prod => $qte){
    $result = $conn -> prepare("Select prixHTprod, prixHTpromoPro, estPromoProd FROM Produit WHERE idProd = ?");
    $result->execute(array($prod));
    $donnees = $result->fetch(PDO::FETCH_ASSOC);
    if($donnees['estPromoProd'] == 1){
      $prix += $donnees['prixHTpromoPro'] * $qte;
    } else {
      $prix += $donnees['prixHTprod'] * $qte;
    }
    $result->closeCursor();
  }
  $req = $conn -> prepare("INSERT INTO Commande VALUES(NULL, ?, NULL, NULL, 0, NULL, NULL, ?)");
  $req->execute(array($date, $prix));
  
  foreach($_COOKIE['panier'] as $prod => $qte){
    $prix = 0;
    $result = $conn -> prepare("Select prixHTprod, prixHTpromoPro, estPromoProd FROM Produit WHERE idProd = ?");
    $result->execute(array($prod));
    $donnees = $result->fetch(PDO::FETCH_ASSOC);
    if($donnees['estPromoProd'] == 1){
      $prix += $donnees['prixHTpromoPro'] * $qte;
    } else {
      $prix += $donnees['prixHTprod'] * $qte;
    }
    $result->closeCursor();
    $reqCom = $conn -> prepare("SELECT MAX(idCom) FROM Commande");
    $reqCom->execute();
    $idCom = $reqCom->fetch(PDO::FETCH_NUM);
    $req = $conn -> prepare("INSERT INTO DetailCommande VALUES(?, ?, ?, ?)");
    $req->execute(array($prod, $idCom[0], $qte, $prix));
    $reqCom->closeCursor();
  }
  
  header('location:AjouterClient.php');