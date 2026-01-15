<?php
// conencter db
function conencter()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "centre_formation";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
        // Set the PDO error mode to exception for robust error handling
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Disable emulation mode for better security and performance with prepared statements
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $conn;
    } catch (PDOException $e) {
        // Catch and display any connection errors
        die("Connection failed: " . $e->getMessage());
    }
}


// ajouter 

function ajouter($code, $intitule, $description,$dureeHeures,$prix)
{
    // Use the passed parameters (caller may use GET/POST to provide them)
    try {
        $cnx = conencter();
        $r = $cnx->prepare("insert into cours(code,intitule,description,dureeHeures,prix) values(?,?,?,?,?)");
        $r->execute([$code, $intitule, $description, $dureeHeures, $prix]);
    } catch (\Throwable $e) {
        echo 'erreur' . $e->getMessage();
    }
}
// delete 
function delete($id)
{
    try {
        $cnx = conencter();
        $r = $cnx->prepare("DELETE FROM cours WHERE id=?");
        $r->execute([$id]);
    } catch (\Throwable $e) {
        echo 'erreur' . $e->getMessage();
    }
}

// update

function update($id, $code, $intitule, $description, $dureeHeures, $prix)
{
    try {
        $cnx = conencter();
        $r = $cnx->prepare("UPDATE cours SET code = ?, intitule = ?, description = ?, dureeHeures = ?, prix = ? WHERE id = ?");
        $r->execute([$code, $intitule, $description, $dureeHeures, $prix, $id]);
    } catch (\Throwable $e) {
        echo 'erreur' . $e->getMessage();
    }
}

function findById($id)
{
    try {
        $cnx = conencter();
        $r = $cnx->prepare("SELECT * FROM cours WHERE id = ?");
        $r->execute([$id]);
        $item = $r->fetch(PDO::FETCH_ASSOC);
        return $item;
    } catch (\Throwable $e) {
        echo 'erreur' . $e->getMessage();
    }
    return null;
}

function findByCode($code)
{
    try {
        $cnx = conencter();
        $r = $cnx->prepare("SELECT * FROM cours WHERE code = ?");
        $r->execute([$code]);
        $item = $r->fetch(PDO::FETCH_ASSOC);
        return $item;
    } catch (\Throwable $e) {
        echo 'erreur' . $e->getMessage();
    }
    return null;
}



// select all
function selectAllCours(): array
{
    try {
        $cnx = conencter();
        $r = $cnx->prepare("SELECT * FROM cours");
        $r->execute();
        $products = $r->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        echo 'Erreur lors de la sélection : ' . $e->getMessage();
    }
    return $products;
}

function all()
{
    $dbh =    conencter();
    $r = $dbh->prepare("select * from cours");
    $r->execute();
    $products = $r->fetchAll();
    return $products;
}


function uploadImg($file)
{

    if ($file["error"] !== 0) {
        return null;
    }
    $tmp = $file['error'];

    $name = time() . "_" . basename($file['error']);

    $folder = "apload";

    $destination = $folder . $name;
}