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

function ajouter($nom,$prenom,$matricule,$email,$telephone,$specialite)
{
    $nom = $_GET['nom'];
    $prenom = $_GET['prenom'];
    $matricule = $_GET['matricule'];
    $email = $_GET['email'];
    $telephone = $_GET['telephone'];
    $specialite = $_GET['specialite'];

    try {
        $cnx = conencter();
        $r = $cnx->prepare("insert into professeur(nom,prenom,matricule,email,telephone,specialite) values(?,?,?,?,?,?)");
        $r->execute([$nom,$prenom,$matricule,$email,$telephone,$specialite]);
    } catch (\Throwable $e) {
        echo 'erreur' . $e->getMessage();
    }
}
// delete 
function delete($id)
{
    try {
        $cnx = conencter();
        $r = $cnx->prepare("DELETE FROM professeur WHERE id=?");
        $r->execute([$id]);
    } catch (\Throwable $e) {
        echo 'erreur' . $e->getMessage();
    }
}

// update

function update($id, $nom, $prenom, $matricule, $email, $telephone, $specialite)
{
    try {
        $cnx = conencter();
        $r = $cnx->prepare("UPDATE professeur SET nom = ?, prenom = ?, matricule = ?, email = ?, telephone = ?, specialite = ? WHERE id = ?");
        $r->execute([$nom, $prenom, $matricule, $email, $telephone, $specialite, $id]);
    } catch (\Throwable $e) {
        echo 'erreur' . $e->getMessage();
    }
}



// select all
function selectAllProf(): array
{
    try {
        $cnx = conencter();
        $r = $cnx->prepare("SELECT * FROM professeur");
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
    $r = $dbh->prepare("select * from produit");
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
