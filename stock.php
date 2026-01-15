<?php
include_once("inscription.php");
if (
    isset($_GET["etud"], $_GET["cours"], $_GET["date"], $_GET["st"], $_GET["nt"])
) {
    $etudiant_id = $_GET["etud"];
    $cours_id = $_GET["cours"];
    $dateInscription = $_GET["date"];
    $statut = $_GET["st"];
    $note = $_GET["nt"];

    ajouter_inscrip($etudiant_id, $cours_id, $dateInscription, $statut, $note);
}
$INSCRi = all_inscrip();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>EduCenter | Inscriptions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f7fb;
        }

        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: linear-gradient(180deg, #0d1b2a, #000814);
        }

        .sidebar a {
            color: #cbd5e1;
            text-decoration: none;
            padding: 12px 16px;
            display: block;
            border-radius: 8px;
            margin-bottom: 6px;
        }

        .sidebar a.active,
        .sidebar a:hover {
            background-color: #1d4ed8;
            color: #fff;
        }

        .content {
            padding: 30px;
        }
    </style>
</head>

<body>

    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar p-3">
            <h4 class="text-white mb-4">🎓 EduCenter</h4>
            <a href="dashboard.php">Tableau de bord</a>
            <a href="etudiant.php">Étudiants</a>
            <a href="index2.php">Professeurs</a>
            <a href="principale.php">Cours</a>
            <a href="#" class="active">Inscriptions</a>
            <a href="rapports.php">Rapports</a>

        </div>

        <!-- Content -->
        <div class="flex-grow-1 content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>Gestion des Inscriptions</h3>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addInscriptionModal">
                    <i class="bi bi-plus-lg"></i> Ajouter une inscription
                </button>
            </div>

            <!-- Table Inscriptions -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table table-hover align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Étudiant</th>
                                <th>Cours</th>
                                <th>Date</th>
                                <th>Statut</th>
                                <th>Note</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($INSCRi as $inscription): ?>
                                <tr>
                                    <td><?= $inscription['etudiant_id'] ?></td>
                                    <td><?= $inscription['cours_id'] ?></td>
                                    <td><?= $inscription['dateInscription'] ?></td>
                                    <td><?= $inscription['statut'] ?></td>
                                    <td><?= $inscription['note'] ?></td>
                                    <td>
                                        <a onclick=";" href="deleteM.php?id=<?= $inscription['id'] ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                                        <!-- <a href="update.php?id=<?= $inscription['id'] ?>" class="btn btn-info btn-sm"><i class="bi bi-pencil"></i></a> -->
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal Ajouter Inscription -->
            <form action="stock.php" method="GET">
                <div class="modal fade" id="addInscriptionModal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Ajouter une inscription</h5>
                                <button class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form action="ajouter_inscription.php" method="GET">
                                    
                                    <div class="mb-3">
                                        <label class="form-label">ID Étudiant</label>
                                        <select class="form-select" name="etud" aria-label="Default select example">
                                            <option selected disabled>Choisir un étudiant...</option>

                                            <?php
                                            // 1. On utilise votre fonction de connexion existante
                                            $cnx = conencter();

                                            // 2. On récupère les étudiants (id pour la valeur, nom/prenom pour l'affichage)
                                            $requete = "SELECT id, nom, prenom FROM etudiant ORDER BY nom ASC";
                                            $resultats = $cnx->query($requete);

                                            // 3. On boucle sur chaque étudiant pour créer une ligne <option>
                                            while ($ligne = $resultats->fetch(PDO::FETCH_ASSOC)) {
                                                echo "<option value='" . $ligne['id'] . "'>" . $ligne['nom'] . " " . $ligne['prenom'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>


                                    <div class="mb-3">
                                        <label class="form-label">Titre du Cours</label>
                                        <select class="form-select" name="cours" aria-label="Default select example">
                                            <option selected disabled>-- Sélectionner le cours --</option>

                                            <?php
                                            // 1. On utilise votre fonction de connexion
                                            $cnx = conencter();

                                            // 2. Requête pour récupérer les cours (id et intitule)
                                            $requete_cours = "SELECT id, intitule FROM cours ORDER BY intitule ASC";
                                            $resultats_cours = $cnx->query($requete_cours);

                                            // 3. Boucle pour créer les options
                                            while ($ligne = $resultats_cours->fetch(PDO::FETCH_ASSOC)) {
                                                // value = l'ID du cours, texte affiché = le titre du cours
                                                echo "<option value='" . $ligne['id'] . "'>" . $ligne['intitule'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>


                                    <div class="mb-3">
                                        <label class="form-label">Date</label>
                                        <input type="date" class="form-control" name="date">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Statut</label>
                                        <select class="form-select" name="st">
                                            <option value="INSCRIT">INSCRIT</option>
                                            <option value="ANNULE">ANNULE</option>
                                            <option value="TERMINE">TERMINE</option>
                                        </select>
                                    </div>


                                    <div class="mb-3">
                                        <label class="form-label">Note</label>
                                        <input type="text" class="form-control" name="nt">
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                                        <button class="btn btn-primary">Ajouter</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>