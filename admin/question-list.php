<?php

require_once '../tools/common.php';

if(!isset($_SESSION['user']) OR $_SESSION['user']['is_admin'] == 0){
    header('location:../index.php');
    exit;
}

//supprimer la question dont l'ID est envoyé en paramètre URL
if(isset($_GET['id_question']) && isset($_GET['action']) && $_GET['action'] == 'delete'){

    $query = $db->prepare('DELETE FROM faq_question WHERE id_question = ?');
    $result = $query->execute(
        [
            $_GET['id_question']
        ]
    );

    $query = $db->prepare('DELETE FROM faq_question WHERE id = ?');
    $result = $query->execute(
        [
            $_GET['id_question']
        ]
    );
    if($result){
        $message = "Suppression effectuée.";
    }
    else{
        $message = "Impossible de supprimer la sélection.";
    }
}

$query = $db->query('SELECT * FROM faq_question ORDER BY id DESC');
$questions = $query->fetchall();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Administration de la FAQ - Melun</title>
    <?php require 'partials/head_assets.php'; ?>
</head>
<body class="index-body">
<div class="container-fluid">
    <?php require 'partials/header.php'; ?>

    <div class="row my-3 index-content">

        <?php require 'partials/nav.php'; ?>

        <section class="col-9">
            <header class="pb-4 d-flex justify-content-between">
                <h4>Liste des questions</h4>
                <a class="btn btn-primary" href="question-form.php">Ajouter une question</a>
            </header>

            <?php if(isset($message)): ?>
                <div class="bg-success text-white p-2 mb-4">
                    <?= $message; ?>
                </div>
            <?php endif; ?>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Titre</th>
                    <th>Contenu</th>
                    <th>Catégorie</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php if($questions): ?>
                    <?php foreach($questions as $question): ?>

                        <tr>
                            <th><?= htmlentities($question['id']); ?></th>
                            <td><?= htmlentities($question['subject']); ?></td>
                            <td><?= htmlentities($question['content']); ?></td>
                            <td><?= htmlentities($question['category_id']); ?></td>
                            <td>
                                <a href="question-form.php?id_question=<?= $question['id']; ?>&action=edit" class="btn btn-warning">Modifier</a>
                                <a onclick="return confirm('Are you sure?')" href="question-list.php?id_question=<?= $question['id']; ?>&action=delete" class="btn btn-danger">Supprimer</a>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                <?php else: ?>
                    Aucune question enregistrée.
                <?php endif; ?>

                </tbody>
            </table>

        </section>

    </div>

</div>
</body>
</html>
