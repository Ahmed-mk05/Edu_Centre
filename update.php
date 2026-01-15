<?php
include_once 'function.php'; // Assurez-vous que ce fichier contient votre connexion PDO
$cnx = conencter(); // Ou la fonction que vous utilisez pour la connexion

$id = $_GET['id'] ?? 0;

// 1. On récupère les infos du professeur
$sql = "SELECT * FROM professeur WHERE id = :id";
$stmt = $cnx->prepare($sql);
$stmt->execute(['id' => $id]);
$prof = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$prof) die("Professeur introuvable.");

// 2. Traitement de la modification
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $specialite = $_POST['specialite'];

    $sql_up = "UPDATE professeur SET nom=:n, prenom=:p, email=:e, specialite=:s WHERE id=:id";
    $stmt_up = $cnx->prepare($sql_up);
    
    if ($stmt_up->execute(['n'=>$nom, 'p'=>$prenom, 'e'=>$email, 's'=>$specialite, 'id'=>$id])) {
        header("Location:index2.php"); // Retour à la liste
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Professeur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container" style="max-width: 600px;">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Modifier Professeur : <?= htmlspecialchars($prof['nom']) ?></h5>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($prof['nom']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Prénom</label>
                        <input type="text" name="prenom" class="form-control" value="<?= htmlspecialchars($prof['prenom']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($prof['email']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Spécialité</label>
                        <select class="form-select" name="specialite">
                            <option <?= $prof['specialite'] == 'Developpement web' ? 'selected' : '' ?>>Developpement web</option>
                            <option <?= $prof['specialite'] == 'data science' ? 'selected' : '' ?>>data science</option>
                            <option <?= $prof['specialite'] == 'AI' ? 'selected' : '' ?>>AI</option>
                            <option <?= $prof['specialite'] == 'Infographie' ? 'selected' : '' ?>>Infographie</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="index2.php" class="btn btn-secondary">Annuler</a>
                        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>