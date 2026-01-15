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
    include_once 'function.php';
    $profs = selectAllProf();
?>

<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar p-3">
        <h4 class="text-white mb-4">🎓 EduCenter</h4>
        <a href="dashboard.php">Tableau de bord</a>
        <a href="etudiant.php">Étudiants</a>
        <a href="#" class="active">Professeurs</a>
        <a href="principale.php">Cours</a>
        <a href="stock.php">Inscriptions</a>
        <a href="rapports.php">Rapports</a>

    </div>

    <!-- Content -->
    <div class="flex-grow-1 content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Gestion des Professeurs</h3>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProfModal">
                <i class="bi bi-plus-lg"></i> Ajouter un professeur
            </button>
        </div>

        <!-- Search -->

        <!-- Table -->
        <div class="card shadow-sm">
            <div class="card-body">
            <?= count($profs); ?>
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Matricule</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Spécialité</th>
                            <th>Actions</th>
                        </tr>
                    </thead>


                    <tbody>
                    <?php foreach ($profs as $professeur): ?>
                        <tr>
                            <td><?= $professeur['id'] ?></td>
                            <td><?= $professeur['nom'] ?></td>
                            <td><?= $professeur['prenom'] ?></td>
                            <td><?= $professeur['email'] ?></td>
                            <td><?= $professeur['matricule'] ?></td>
                            <td></span><?= $professeur['specialite'] ?></span></td>
                            <td>
                                <a onclick="return confirm('supprimer?');" href="delete.php?id=<?= $professeur['id'] ?>" class="btn btn-danger"> <i class="bi bi-trash"></i></a>
                                
                                <a href="update.php?id=<?= $professeur['id'] ?>" class="btn btn-primary"> 
    <i class="bi bi-pencil"></i>
</a>                            </td>
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
                <h5 class="modal-title">Ajouter un professeur</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="ajouter.php" method="get">
                    <div class="mb-3">
                        <label class="form-label">Matricule</label>
                        <input type="text" class="form-control" name="matricule" placeholder="matricule" id="matricule">
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Nom</label>
                            <input type="text" class="form-control" name="nom" placeholder="nom" id="nom">
                        </div>
                        <div class="col mb-3">
                            <label class="form-label">Prénom</label>
                            <input type="text" class="form-control" name="prenom" placeholder="prenom" id="prenom">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="email" id="email">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Téléphone</label>
                        <input type="text" class="form-control" name="telephone" placeholder="telephone" id="telephone">
                    </div>

                    <div class="mb-3">
                    <select class="form-select" name="specialite" aria-label="Default select example" placeholder="specialite" id="specialite">
                        <option selected disabled>specialite</option>
                        <option >Developpement web</option>
                        <option >data science</option>
                        <option >AI</option>
                        <option >Infographie</option>
                    </select>
                        
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
