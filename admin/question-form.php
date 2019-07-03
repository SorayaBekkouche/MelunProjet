<?php

require_once '../tools/common.php';

if(!isset($_SESSION['user']) OR $_SESSION['user']['is_admin'] == 0){
    header('location:../index.php');
    exit;
}

$messages = [];
if(isset($_POST['save'])) {

    if (empty($_POST['subject'])) {
        $messages['subject'] = 'tfgvhj';
    }
    if (empty($_POST['content'])) {
        $messages['content'] = 'tfgvhj';
    }
    if (empty($messages)) {
        $query = $db->prepare('INSERT INTO faq_question (subject, content, category_id) VALUES (?, ?, ?)');
        $newQst = $query->execute(
            [
                htmlspecialchars($_POST['subject']),
                htmlspecialchars($_POST['content']),
                $_POST['category_id']
            ]
        );

        if ($newQst) {
            $_SESSION['message'] = 'Question ajoutée';
            header('location:question-list.php');
            exit;
        }
    }
}
if(isset($_POST['update'])) {

    if (empty($_POST['subject'])) {
        $messages['subject'] = 'question';
    }
    if (empty($_POST['content'])) {
        $messages['content'] = 'réponse';
    }
    if (empty($messages)) {

        $query = $db->prepare('UPDATE faq_question SET subject = :subject, content = :content, category_id = :category_id WHERE id = :id');
        $newQst = $query->execute(
            [
                'subject' => htmlspecialchars($_POST['subject']),
                'content' => htmlspecialchars($_POST['content']),
                'category_id' => $_POST['category_id'],
                'id' => $_POST['id']
            ]
        );

        if ($newQst){
            $_SESSION['message'] = 'question modifiée';
            header('location:question-list.php');
            exit;
        }
    }
}

if(isset($_GET['id_question']) && isset($_GET['action']) && $_GET['action'] == 'edit'){

    $query = $db->prepare('SELECT * FROM faq_question WHERE id = ?');
    $query->execute(array($_GET['id_question']));
    $question = $query->fetch();
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Melun - Admin FAQ</title>

    <?php require 'partials/head_assets.php'; ?>

</head>
<body class="index-body">
<div class="container-fluid">

    <?php require 'partials/header.php'; ?>

    <div class="row my-3 index-content">
        <?php require 'partials/nav.php'; ?>

        <section class="col-9">

            <header class="pb-3">
                <h4><?php if(isset($question)): ?>Modifier<?php else: ?>Ajouter<?php endif; ?> une question</h4>
            </header>


            <div class="tab-content">
                    <?php if(isset($message)): ?>
                        <div class="bg-danger text-white">
                            <?= $message; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($_GET['id'])): ?>
                    <form action="question-form.php?id=<?= $question['id'];?>&action=edit" method="post" enctype="multipart/form-data">
                        <?php else: ?>
                        <form action="question-form.php" method="post" enctype="multipart/form-data">
                            <?php endif; ?>
                            <div class="form-group">
                                <label for="subject">Sujet</label>
                                <input class="form-control" type="text" name="subject" id="subject" />
                            </div>

                            <div class="form-group">
                                <label for="content">Réponse</label>
                                <textarea class="form-control" name="content"id="sample"></textarea>

                            </div>

                            <div class="form-group">
                                <label for="category_id"> Catégorie :</label>
                                <select class="form-control" name="category_id" id="category_id">
                                    <?php
                                    $query = $db->query('SELECT * FROM faq_category');
                                    $cats = $query->fetchAll();
                                    ?>
                                    <?php foreach ($cats as $cat): ?>
                                        <option value="<?= $cat['id']; ?>" <?= isset($question) AND $question['category_id'] == $cat['id'] ? 'selected' : ''; ?>><?= $cat['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="text-right">
                                <?php if(isset($question)): ?>
                                    <input class="btn btn-success" type="submit" name="update" value="Mettre à jour" />
                                <?php else: ?>
                                    <input class="btn btn-success" type="submit" name="save" value="Enregistrer" />
                                <?php endif; ?>
                            </div>

                            <?php if(isset($question)): ?>
                                <input type="hidden" name="id" value="<?= $question['id']; ?>" />
                            <?php endif; ?>

                        </form>
            </div>
        </section>
    </div>
</div>
</body>
<script>
    const suneditor = SUNEDITOR.create((document.getElementById('sample') || 'sample'),{
        // All of the plugins are loaded in the "window.SUNEDITOR" object in dist/suneditor.min.js file
        // Insert options
        // Language global object (default: en)
        lang: SUNEDITOR_LANG['ko']
    });
</script>

</html>
