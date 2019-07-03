<?php

require_once '../tools/common.php';

if(isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'delete'){

    $result = $db->prepare('SELECT image FROM bills WHERE id = ?');
    $result->execute([
        $_GET['id']
    ]);

    $getBill = $result->fetch();


    $query = $db->prepare('DELETE FROM bills WHERE id = ?');
    $result = $query->execute([
        $_GET['id']
    ]);

    unlink('../img/bills/' . $getBill['image']);

    //générer un message à afficher plus bas pour l'administrateur
    if($result){
        $_SESSION['message'] = "Suppression efféctuée.";
    }
    else{
        $message = "Impossible de supprimer la séléction.";
    }
}
//séléctionner tous les utilisateurs pour affichage de la liste
$query = $db->query('SELECT * FROM bills');
$bill = $query->fetchall();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Administration des utilisateurs - Site d'une ville !</title>
    <?php require 'partials/head_assets.php'; ?>
</head>
<body class="index-body">
<div class="container-fluid">

    <?php require 'partials/header.php'; ?>

    <div class="row my-3 index-content">

        <?php require 'partials/nav.php'; ?>

        <section class="col-9">
            <header class="pb-4 d-flex justify-content-between">
                <h4>Liste des Factures</h4>
                <a class="btn btn-primary" href="bills-form.php">Ajouter une facture</a>
            </header>

            <?php if(isset($_SESSION['message'])): ?>
                <div class="bg-success text-white p-2 mb-4">
                    <?= $_SESSION['message']; ?>
                    <?php unset($_SESSION['message']); ?>
                </div>
            <?php endif; ?>

            <?php if($bill): ?>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Utilisateur</th>
                        <th>Document</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($bill as $bills): ?>
                        <tr>
                            <!-- htmlentities sert à écrire les balises html sans les interpréter -->
                            <th><?= htmlentities($bills['id']); ?></th>
                            <td><?= htmlentities($bills['first_name']); ?></td>
                            <td><?= htmlentities($bills['last_name']); ?></td>
                            <td><?= htmlentities($bills['user_id']); ?></td>
                            <td><?= htmlentities($bills['image']); ?></td>
                            <td>
                                <a href="bills-form.php?id=<?= $bills['id']; ?>&action=edit" class="btn btn-warning">Modifier</a>
                                <a onclick="return confirm('Are you sure?')" href="bills.php?id=<?= $bills['id']; ?>&action=delete" class="btn btn-danger">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                Aucune facture disponible.
            <?php endif; ?>

        </section>

    </div>

</div>
</body>
</html>
