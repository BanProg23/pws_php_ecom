<?php
  try{
    $user = 'umy48';
    $pass = 'tutetais';
    $conn = new PDO('mysql:host=localhost;dbname=base48;charset=UTF8', $user, $pass);
  } catch(PDOException $e) {
    echo "$e";
  }