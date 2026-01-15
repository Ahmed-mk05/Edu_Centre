<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Clients</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <style>
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f4f4f4;
        }
    </style>
</head>

<body>

    <?php
    include_once 'function.php';
    $profs = selectAllProf();


    ?>

    <h1 style="text-align: center;">Liste des professeur</h1>

    <!-- <h2>le nombre de produits est <?= count($profs); ?> </h2> -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>nom</th>
                <th>prenom</th>
                <th>matricule</th>
                <th>specialitex</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($profs as $professeur): ?>
                <tr>
                    <td><?= $professeur['id'] ?></td>
                    <td><?= $professeur['nom'] ?></td>
                    <td><?= $professeur['prenom'] ?></td>
                    <td><?= $professeur['matricule'] ?></td>
                    <td><?= $professeur['specialite'] ?></td>
                    <td>
                        <a onclick="return confirm('supprimer?');" href="delete.php?id=<?= $professeur['id'] ?>" class="btn btn-danger">-</a>
                        <a onclick="return confirm('modifier?');" href="update.php?id=<?= $professeur['id'] ?>" class="btn btn-warning">M</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>