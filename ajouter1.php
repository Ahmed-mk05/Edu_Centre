<?php 
include_once ('cours.php');
ajouter($_GET['code'],$_GET['intitule'],$_GET['description'],$_GET['dureeHeures'],$_GET['prix']);
header('location:principale.php');