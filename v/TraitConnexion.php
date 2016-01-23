<?php
  session_start();
  if(isset($_POST['login']) && isset($_POST['motPasse'])) {
    if(!empty($_POST['login']) && !empty($_POST['motPasse'])) {
      if($_POST['login'] == 'admin' && $_POST['motPasse'] == 'admin') {
        $_SESSION['identifie'] = 'OK';
        if(isset($_POST['cb_souvenirMoi']) && $_POST['cb_souvenirMoi'] == 'Yes') {
          setcookie('cookIdent', 'Contenu d\'identification', time() + 3600*24*60);
        }
        header('Location: index.php');
      } else {
        header('Location: formConnexion.php?msgErreur=Identifiants%20incorrects%20!');
      }
    } else {
      header('Location: formConnexion.php?msgErreur=Identifiants%20incorrects%20!');
    }
  } else {
    if(isset($_COOKIE['cookIdent'])) {
      $_SESSION['identifie'] = 'OK';
      setcookie('cookIdent', 'Contenu d\'identification', time() + 3600*24*60);
      header('Location: index.php');
    } else {
      header('Location: formConnexion.php?msgErreur=Identifiants%20incorrects%20!');
    }
  }
?>