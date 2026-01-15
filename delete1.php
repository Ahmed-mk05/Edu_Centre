<?php
include_once('cours.php');
delete($_GET['id']);
header('location:principale.php');