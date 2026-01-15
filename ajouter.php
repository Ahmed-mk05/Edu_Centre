<?php 
include_once ('function.php');
ajouter($_GET['nom'],$_GET['prenom'],$_GET['matricule'],$_GET['email'],$_GET['telephone'],$_GET['specialite']);
header('location:index2.php');
