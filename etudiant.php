<?php
// ================= CONNEXION =================
try {
    $pdo = new PDO("mysql:host=localhost;dbname=centre_formation;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur connexion : " . $e->getMessage());
}

// ================= AJOUTER =================
if (isset($_POST['ajouter'])) {
    $stmt = $pdo->prepare(
        "INSERT INTO Etudiant (cne, nom, prenom, email, telephone, dateInscription)
        VALUES (?, ?, ?, ?, ?, ?)"
    );
    $stmt->execute([
        $_POST['cne'],
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['email'],
        $_POST['telephone'],
        $_POST['dateInscription']
    ]);
    header("Location: etudiant.php");
}

// ================= MODIFIER =================
if (isset($_POST['modifier'])) {
    $stmt = $pdo->prepare(
        "UPDATE etudiant 
        SET nom=?, prenom=?, email=?, telephone=?, dateInscription=?
        WHERE cne=?"
    );
    $stmt->execute([
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['email'],
        $_POST['telephone'],
        $_POST['dateInscription'],
        $_POST['cne']
    ]);
    header("Location: etudiant.php");
}

// ================= SUPPRIMER =================
if (isset($_POST['supprimer'])) {
    $stmt = $pdo->prepare("DELETE FROM etudiant WHERE cne=?");
    $stmt->execute([$_POST['cne']]);
    header("Location: etudiant.php");
}

// ================= LISTE =================
$etudiants = $pdo->query("SELECT * FROM etudiant")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Gestion Étudiants</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.sidebar {
    width: 240px;
    min-height: 100vh;
    background: linear-gradient(180deg, #0d1b2a, #000814);
    color: #fff;
}
.sidebar a {
    display: block;
    padding: 12px 16px;
    color: #cbd5e1;
    text-decoration: none;
    border-radius: 8px;
    margin-bottom: 6px;
    margin: 6PX 16px;
}
.sidebar a.active, .sidebar a:hover {
    background-color: #1d4ed8;
    color: #fff;
    }

.content {
    padding: 30px;
    width: 100%;
}
.modal-header-add {
    background: #0d6efd;
    color: white;
}
.modal-header-edit {
    background: #f59e0b;
    color: white;
}
</style>
</head>

<body>

<div class="d-flex">

<!-- SIDEBAR -->
<div class="sidebar">
    <h4 class="text-center py-3">🎓 EduCenter</h4>
    <a href="dashboard.php">Tableau de bord</a>
    <a href="#"class="active">Étudiants</a>
    <a href="index2.php">Professeurs</a>
    <a href="principale.php">Cours</a>
    <a href="stock.php">Inscription</a>
    <a href="rapports.php">Rapports</a>

</div>

<!-- CONTENT -->
<div class="content">

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Gestion des Étudiants</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAjouter">
        + Ajouter un étudiant
    </button>
</div>


<div class="card shadow">
<div class="card-body">
<table class="table table-hover">
<thead class="table-light">
<tr>
    <th>CNE</th>
    <th>Nom</th>
    <th>Prénom</th>
    <th>Email</th>
    <th>Téléphone</th>
    <th>Date</th>
    <th>Actions</th>
</tr>
</thead>
<tbody>

<?php foreach ($etudiants as $e): ?>
<tr>
    <td><?= $e['cne'] ?></td>
    <td><?= $e['nom'] ?></td>
    <td><?= $e['prenom'] ?></td>
    <td><?= $e['email'] ?></td>
    <td><?= $e['telephone'] ?></td>
    <td><?= $e['dateInscription'] ?></td>
    <td>
        
        <!-- SUPPRIMER -->
        <form method="POST" style="display:inline">
            <input type="hidden" name="cne" value="<?= $e['cne'] ?>">
            <button name="supprimer" class="btn btn-danger"
                onclick="return confirm('Supprimer cet étudiant ?')">
                🗑️
            </button>
        </form>
        <!-- MODIFIER -->
        <button class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#modalModifier<?= $e['cne'] ?>">
            ✏️
        </button>


    </td>
</tr>

<!-- MODAL MODIFIER -->
<div class="modal fade" id="modalModifier<?= $e['cne'] ?>">
<div class="modal-dialog modal-dialog-centered modal-lg">
<div class="modal-content">
<form method="POST">

<div class="modal-header modal-header-edit">
<h5 class="modal-title">Modifier Étudiant</h5>
<button class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
<input type="hidden" name="cne" value="<?= $e['cne'] ?>">

<label>Nom</label>
<input type="text" name="nom" class="form-control mb-2" value="<?= $e['nom'] ?>">

<label>Prénom</label>
<input type="text" name="prenom" class="form-control mb-2" value="<?= $e['prenom'] ?>">

<label>Email</label>
<input type="email" name="email" class="form-control mb-2" value="<?= $e['email'] ?>">

<label>Téléphone</label>
<input type="text" name="telephone" class="form-control mb-2" value="<?= $e['telephone'] ?>">

<label>Date inscription</label>
<input type="date" name="dateInscription" class="form-control" value="<?= $e['dateInscription'] ?>">
</div>

<div class="modal-footer">
    <button class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
    <button name="modifier" class="btn btn-warning">Modifier</button>
</div>

</form>
</div>
</div>
</div>

<?php endforeach; ?>

</tbody>
</table>
</div>
</div>

</div>
</div>

<!-- MODAL AJOUTER -->
<div class="modal fade" id="modalAjouter">
<div class="modal-dialog modal-dialog-centered modal-lg">
<div class="modal-content">

<form method="POST">

<div class="modal-header modal-header-add">
<h5 class="modal-title">Ajouter un étudiant</h5>
<button class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
<label>CNE</label>
<input type="text" name="cne" class="form-control mb-2" required>

<div class="row">
<div class="col">
<label>Nom</label>
<input type="text" name="nom" class="form-control mb-2" required>
</div>
<div class="col">
<label>Prénom</label>
<input type="text" name="prenom" class="form-control mb-2" required>
</div>
</div>

<label>Email</label>
<input type="email" name="email" class="form-control mb-2">

<label>Téléphone</label>
<input type="text" name="telephone" class="form-control mb-2">

<label>Date inscription</label>
<input type="date" name="dateInscription" class="form-control">
</div>

<div class="modal-footer">
<button class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
<button name="ajouter" class="btn btn-primary">Ajouter</button>
</div>

</form>

</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>