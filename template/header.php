<?php
session_start();
$_SESSION['id'] = 1;
$edit = 0;


?>
<!--
     ______          ___                ______           __                  
   / ________  ____/ (_____  ____ _   / ________ ______/ /_____  _______  __
  / /   / __ \/ __  / / __ \/ __ `/  / /_  / __ `/ ___/ __/ __ \/ ___/ / / /
 / /___/ /_/ / /_/ / / / / / /_/ /  / __/ / /_/ / /__/ /_/ /_/ / /  / /_/ / 
 \____/\____/\__,_/_/_/ /_/\__, /  /_/    \__,_/\___/\__/\____/_/   \__, /  
                          /____/                                   /____/   

 Team : Paul Derue, Jarno Rameter, Cédric Leprohon, Damien Jisseau
 Thanks to "Jean-Michel PO"

-->

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./ressources/bootstrap.css">
    <title>Petit comptable</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="index.php">Mon petit comptable</a>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Mes opérations</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="formulaire_cb.php">Mes comptes bancaires</a>
      </li>
  </div>
</nav>
<div class="container mt-4">