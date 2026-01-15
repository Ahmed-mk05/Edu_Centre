<?php 
include_once ('cours.php');

if (isset($_GET['modifier'])) {
    update(
        $_GET['id'],
        $_GET['code'],
        $_GET['intitule'],
        $_GET['description'],
        $_GET['dureeHeures'],
        $_GET['prix']
    );
    header('location:principale.php');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Cours</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            background: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        .card {
            width: 420px;
            margin: 50px auto;
            background: #fff;
            border-radius: 6px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .card-header {
            background: #f39c12;
            color: white;
            padding: 15px;
            font-size: 18px;
            font-weight: bold;
        }

        .card-body {
            padding: 70px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn-cancel {
            background: #ccc;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-submit {
            background: #f1c40f;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-submit:hover {
            background: #e1b20c;
        }
    </style>
</head>

<body>

<div class="card">
    <div class="card-header">
        ✏️ Modifier Cours
    </div>

    <div class="card-body">
        <form method="get">
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

            <label>Code</label>
            <input type="text" name="code" placeholder="Code du cours">

            <label>Intitulé</label>
            <input type="text" name="intitule" placeholder="Intitulé du cours">

            <label>Description</label>
            <input type="text" name="description" placeholder="Description">

            <label>Durée (heures)</label>
            <input type="text" name="dureeHeures" placeholder="Durée en heures">

            <label>Prix</label>
            <input type="text" name="prix" placeholder="Prix">

            <div class="actions">
                <a href="principale.php">
                    <button type="button" class="btn-cancel">Annuler</button>
                </a>
                <button type="submit" name="modifier" class="btn-submit">
                    Modifier
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>