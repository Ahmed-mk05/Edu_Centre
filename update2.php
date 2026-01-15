<?php 
include_once('function.php');

$prof = null;

// récupérer données
if (isset($_GET['id'])) {
    $cnx = conencter();
    $r = $cnx->prepare("SELECT * FROM professeur WHERE id = ?");
    $r->execute([$_GET['id']]);
    $prof = $r->fetch(PDO::FETCH_ASSOC);
}

// UPDATE
if (isset($_POST['modifier'])) {
    update(
        $_POST['id'],
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['matricule'],
        $_POST['email'],
        $_POST['telephone'],
        $_POST['specialite']
    );
    header('Location: index2.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Professeur</title>
</head>
<body>

<h2>Modifier</h2>

<form method="post">

    <input type="hidden" name="id" value="<?= $prof['id']; ?>">

    <input type="text" name="nom"
           value="<?= $prof['nom']; ?>" placeholder="nom"><br><br>

    <input type="text" name="prenom"
           value="<?= $prof['prenom']; ?>" placeholder="prenom"><br><br>

    <input type="text" name="matricule"
           value="<?= $prof['matricule']; ?>" placeholder="matricule"><br><br>

    <input type="text" name="email"
           value="<?= $prof['email']; ?>" placeholder="email"><br><br>

    <input type="text" name="telephone"
           value="<?= $prof['telephone']; ?>" placeholder="telephone"><br><br>

    <input type="text" name="specialite"
           value="<?= $prof['specialite']; ?>" placeholder="specialite"><br><br>

    <button type="submit" name="modifier">Modifier</button>
</form>

</body>
</html>


<!-- ----------------------------------------- -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Professeur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="bi bi-pencil-square"></i> Modifier Professeur
                    </h5>
                </div>

                <div class="card-body">
                    <form method="get">

                        <input type="hidden" name="id" value="<?= $prof['id']; ?>">

                        <div class="mb-3">
                            <label class="form-label">Nom</label>
                            <input type="text" name="nom" class="form-control"
                                   value="<?= $prof['nom']; ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Prénom</label>
                            <input type="text" name="prenom" class="form-control"
                                   value="<?= $prof['prenom']; ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Matricule</label>
                            <input type="text" name="matricule" class="form-control"
                                   value="<?= $prof['matricule']; ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?= $prof['email']; ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Téléphone</label>
                            <input type="text" name="telephone" class="form-control" value="<?= $prof['telephone']; ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Spécialité</label>
                            <input type="text" name="specialite" class="form-control" value="<?= $prof['specialite']; ?>">
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="index2.php" class="btn btn-light">Annuler</a>
                            <button type="submit" name="modifier" class="btn btn-warning">
                                Modifier
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</body>
</html>

