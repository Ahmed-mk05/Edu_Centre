<?php
include_once("connex.php");
$cnx = conencter();

// 1. Requête principale pour lier Etudiants, Cours et Professeurs
$sql_global = "SELECT 
                e.nom AS e_nom, 
                e.prenom AS e_prenom, 
                c.intitule AS nom_cours, 
                p.nom AS p_nom, 
                p.prenom AS p_prenom, 
                p.specialite AS p_spe
               FROM etudiant e
               INNER JOIN inscription i ON e.id = i.etudiant_id
               INNER JOIN cours c ON i.cours_id = c.id
               LEFT JOIN professeur p ON c.professeur_id = p.id
               ORDER BY e.nom ASC";

$res_global = $cnx->query($sql_global);

// 2. Requête pour le calcul des frais par étudiant
$sql_frais = "SELECT e.nom, e.prenom, SUM(c.prix) as total 
              FROM etudiant e 
              JOIN inscription i ON e.id = i.etudiant_id 
              JOIN cours c ON i.cours_id = c.id 
              GROUP BY e.id";
$res_frais = $cnx->query($sql_frais);

// --- NOUVELLE SECTION : CALCUL NOMBRE ÉTUDIANTS PAR COURS ---
$sql_stats_cours = "SELECT c.intitule, COUNT(i.id) as nb_etudiants 
                    FROM cours c 
                    LEFT JOIN inscription i ON c.id = i.cours_id 
                    GROUP BY c.id";
$res_stats = $cnx->query($sql_stats_cours);
// ------------------------------------------------------------
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>EduCenter | Rapports & Analyses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8fafc; font-family: 'Inter', sans-serif; }
        .sidebar { width: 250px; height: 100vh; background: #0f172a; position: fixed; color: white; padding: 20px; }
        .sidebar a { color: #94a3b8; text-decoration: none; display: block; padding: 12px; border-radius: 8px; margin-bottom: 5px; }
        .sidebar a:hover, .sidebar a.active { background: #1e293b; color: white; }
        .main-content { margin-left: 250px; padding: 40px; }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .badge-cours { background-color: #3b82f6; color: white; padding: 5px 12px; border-radius: 6px; }
        .prof-info { font-size: 0.9rem; }
        
        /* Nouveau style pour les stats */
        .stat-card-mini { background: white; padding: 20px; border-radius: 12px; border-left: 4px solid #3b82f6; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .stat-number { font-size: 1.5rem; font-weight: bold; color: #0f172a; }
    </style>
</head>
<body>

<div class="sidebar">
    <h4 class="mb-4">🎓 EduCenter</h4>
    <a href="dashboard.php">Tableau de bord</a>
    <a href="etudiant.php">Étudiants</a>
    <a href="index2.php">Professeurs</a>
    <a href="principale.php">Cours</a>
    <a href="stock.php">Inscriptions</a>
    <a href="rapports.php" class="active">Rapports</a>
</div>

<div class="main-content">
    <h2 class="mb-4">Rapports & Analyses</h2>

    <h5 class="mb-3 text-secondary"><i class="bi bi-graph-up me-2"></i>Nombre d'étudiants par cours</h5>
    <div class="row mb-4">
        <?php while($s = $res_stats->fetch(PDO::FETCH_ASSOC)): ?>
        <div class="col-md-3 mb-3">
            <div class="stat-card-mini">
                <div class="text-muted small fw-bold text-uppercase"><?= htmlspecialchars($s['intitule']) ?></div>
                <div class="d-flex align-items-center justify-content-between mt-2">
                    <span class="stat-number"><?= $s['nb_etudiants'] ?></span>
                    <i class="bi bi-people text-primary fs-4"></i>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
    <div class="card p-4 mb-4">
        <h5 class="card-title mb-4 text-primary"><i class="bi bi-person-badge me-2"></i>Liste des Inscriptions : Étudiant, Cours et Professeur</h5>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Étudiant (Nom complet)</th>
                        <th>Cours Suivi</th>
                        <th>Professeur Enseignant</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // On recharge les résultats globaux car ils sont utilisés ci-dessous
                    $res_global = $cnx->query($sql_global); 
                    while($row = $res_global->fetch(PDO::FETCH_ASSOC)): 
                    ?>
                    <tr>
                        <td class="fw-bold"><?= htmlspecialchars(strtoupper($row['e_nom'])." ".$row['e_prenom']) ?></td>
                        <td><span class="badge-cours"><?= htmlspecialchars($row['nom_cours']) ?></span></td>
                        <td>
                            <?php if(!empty($row['p_nom'])): ?>
                                <div class="prof-info">
                                    <span class="d-block fw-bold text-dark"><?= htmlspecialchars($row['p_nom']." ".$row['p_prenom']) ?></span>
                                    <span class="badge bg-info-subtle text-info border border-info-subtle">
                                        <i class="bi bi-mortarboard"></i> <?= htmlspecialchars($row['p_spe']) ?>
                                    </span>
                                </div>
                            <?php else: ?>
                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle">
                                    <i class="bi bi-exclamation-triangle"></i> Aucun professeur assigné
                                </span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card p-4">
    <h5 class="card-title mb-4 text-success">
        <i class="bi bi-cash-stack me-2"></i>Récapitulatif des Frais
    </h5>
    <table class="table align-middle">
        <thead>
            <tr>
                <th>Étudiant</th>
                <th>Total Payé</th>
                <th class="text-end">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($f = $res_frais->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?= htmlspecialchars($f['nom']." ".$f['prenom']) ?></td>
                
                <td class="fw-bold text-primary"><?= number_format($f['total'], 2) ?> DH</td>
                
                <td class="text-end">
                    <a href="facture.php?nom=<?= urlencode($f['nom']) ?>&prenom=<?= urlencode($f['prenom']) ?>&total=<?= $f['total'] ?>" 
                       target="_blank" 
                       class="btn btn-sm btn-primary">
                        <i class="bi bi-printer"></i> Imprimer Facture
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>