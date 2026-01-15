<?php
include_once("connex.php");
$cnx = conencter();

// Statistiques
$count_etud = $cnx->query("SELECT COUNT(*) FROM etudiant")->fetchColumn();
$count_prof = $cnx->query("SELECT COUNT(*) FROM professeur")->fetchColumn();
$count_cours = $cnx->query("SELECT COUNT(*) FROM cours")->fetchColumn();
$count_inscr = $cnx->query("SELECT COUNT(*) FROM inscription")->fetchColumn();

// Dernières inscriptions avec jointure pour les noms
$recent_inscr = $cnx->query("SELECT e.nom, e.prenom, c.intitule, i.statut 
                            FROM inscription i 
                            JOIN etudiant e ON i.etudiant_id = e.id 
                            JOIN cours c ON i.cours_id = c.id 
                            ORDER BY i.id DESC LIMIT 5");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>EduCenter - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --sidebar-bg: #0b1521; /* Couleur sombre de votre image */
            --active-blue: #2563eb; /* Bleu de l'élément sélectionné */
        }
        body { background-color: #f3f6f9; font-family: 'Segoe UI', sans-serif; }
        
        /* Style de la Sidebar comme sur votre image */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: var(--sidebar-bg);
            position: fixed;
            left: 0;
            top: 0;
            padding: 20px 15px;
            color: white;
        }
        .sidebar .brand {
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 40px;
            display: flex;
            align-items: center;
            gap: 10px;
            padding-left: 10px;
        }
        .nav-link {
            color: rgba(255,255,255,0.7) !important;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 5px;
            display: block;
            text-decoration: none;
            transition: 0.3s;
        }
        .nav-link:hover {
            color: white !important;
            background: rgba(255,255,255,0.1);
        }
        .nav-link.active {
            background-color: var(--active-blue) !important;
            color: white !important;
        }
        
        /* Zone de contenu */
        .content {
            margin-left: 250px;
            padding: 40px;
        }
        .stat-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="brand">
        <i class="bi bi-mortarboard-fill"></i> EduCenter
    </div>
    <div class="nav flex-column">
        <a href="dashboard.php" class="nav-link active">Tableau de bord</a>
        <a href="etudiant.php" class="nav-link">Étudiants</a>
        <a href="index2.php" class="nav-link">Professeurs</a>
        <a href="principale.php" class="nav-link">Cours</a>
        <a href="stock.php" class="nav-link">Inscriptions</a>
        <a href="rapports.php" class="nav-link">Rapports</a>
    </div>
</div>

<div class="content">
    <h2 class="mb-4">Gestion du Centre</h2>

    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card stat-card p-4 bg-white border-start border-primary border-4">
                <div class="text-muted small uppercase">Étudiants</div>
                <h3 class="mb-0"><?php echo $count_etud; ?></h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card p-4 bg-white border-start border-success border-4">
                <div class="text-muted small">Professeurs</div>
                <h3 class="mb-0"><?php echo $count_prof; ?></h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card p-4 bg-white border-start border-warning border-4">
                <div class="text-muted small">Cours</div>
                <h3 class="mb-0"><?php echo $count_cours; ?></h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card p-4 bg-white border-start border-info border-4">
                <div class="text-muted small">Inscriptions</div>
                <h3 class="mb-0"><?php echo $count_inscr; ?></h3>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm p-4 rounded-4">
        <h5 class="mb-4">Dernières Inscriptions</h5>
        <table class="table align-middle">
            <thead class="table-light">
                <tr>
                    <th>Étudiant</th>
                    <th>Cours</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $recent_inscr->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><strong><?php echo $row['nom'] . " " . $row['prenom']; ?></strong></td>
                    <td><?php echo $row['intitule']; ?></td>
                    <td>
                        <span class="badge <?php echo ($row['statut'] == 'INSCRIT' ? 'bg-success' : 'bg-danger'); ?>">
                            <?php echo $row['statut']; ?>
                        </span>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>