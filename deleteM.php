<?php
include_once('inscription.php');
suprrimer_inscrip($_GET['id']);
header('location:stock.php');