<?php
function conencter(){
    try {
    $pdo = new PDO ("mysql:host=localhost;dbname=centre_formation", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
} catch (PDOException $e) {
    echo ("Connection failed: " . $e->getMessage());
}
}
?>