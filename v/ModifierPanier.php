<?php 
  if(isset($_POST['Envoyer'])){
    if($_POST['Envoyer'] == "ok"){
      $id = $_POST['idProd'];
      $qte = $_POST[$id];
      setcookie("panier[$id]", $qte, (time() + 3600));
    } else {
      $id = $_POST['idProd'];
      unset($_COOKIE['panier'][$id]);
      setcookie("panier[$id]", '', time() - 3600);
    }
  }
  header('location:VoirPanier.php');