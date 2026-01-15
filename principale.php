<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>EduCenter | Gestion des Professeurs</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
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
        .badge-spec {
            background-color: #eef2ff;
            color: #1e40af;
        }
    </style>
</head>
<body>
<?php
    include_once 'cours.php';
    $Courss = selectAllCours();
?>

<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar p-3">
        <h4 class="text-white mb-4">🎓 EduCenter</h4>
        <a href="dashboard.php">Tableau de bord</a>
        <a href="etudiant.php">Étudiants</a>
        <a href="index2.php" >Professeurs</a>
        <a href="#" class="active">Cours</a>
        <a href="stock.php">Inscriptions</a>
        <a href="rapports.php">Rapports</a>

    </div>

    <!-- Content -->
    <div class="flex-grow-1 content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Gestion des Cours</h3>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProfModal">
                <i class="bi bi-plus-lg"></i> Ajouter un Cours
            </button>
        </div>

        <!-- Search -->
        <!-- <div class="mb-3 col-md-4">
            <input type="text" class="form-control" placeholder="🔍 Rechercher un professeur...">
        </div> -->

        <!-- Table -->
        <div class="card shadow-sm">
            <div class="card-body">
            <?= count($Courss); ?>
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Code</th>
                            <th>Intitule</th>
                            <th>Description</th>
                            <th>Duree Heures</th>
                            <th>Prix</th>
                            <th>Actions</th>
                        </tr>
                    </thead>


                    <tbody>
                    <?php foreach ($Courss as $cours): ?>
                        <tr>
                            <td><?= $cours['id'] ?></td>
                            <td><?= $cours['intitule'] ?></td>
                            <td><?= $cours['description'] ?></td>
                            <td><?= $cours['dureeHeures'] ?></td>
                            <td><?= $cours['prix'] ?></td>
                            <td>
                                <a onclick="return confirm('supprimer?');" href="delete1.php?id=<?= $cours['id'] ?>" class="btn btn-danger"> <i class="bi bi-trash"></i></a>

                                <a  href="update1.php?id=<?= $cours['id'] ?>" class="btn btn-primary"> <i class="bi bi-pencil"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ajouter Professeur -->
<div class="modal fade" id="addProfModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un cours</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="ajouter1.php" method="get">
                    <div class="mb-3">
                        <label class="form-label">Code</label>
                        <input type="text" class="form-control" name="code" placeholder="code" id="code">
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Intitule</label>
                            <input type="text" class="form-control" name="intitule" placeholder="intitule" id="intitule">
                        </div>
                        <div class="col mb-3">
                            <label class="form-label">Description</label>
                            <input type="text" class="form-control" name="description" placeholder="description" id="description">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">dureeHeures</label>
                        <input type="text" class="form-control" name="dureeHeures" placeholder="dureeHeures" id="dureeHeures">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Prix</label>
                        <input type="text" class="form-control" name="prix" placeholder="prix" id="prix">
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














<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>