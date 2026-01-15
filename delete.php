<?php
include_once('function.php');
delete($_GET['id']);
header('location:index2.php');
