<?php

require_once '../tools/common.php';

if(!isset($_SESSION['user']) OR $_SESSION['user']['is_admin'] == 0){
    header('location:../index.php');
    exit;
}
$messages = [];
if(isset($_POST['save'])){

    $allowed_extensions = array('pdf');
    $my_file_extension = pathinfo( $_FILES['image']['name'] , PATHINFO_EXTENSION);

    if (empty($_POST['first_name'])){
        $messages['first_name'] = 'tfgvhj';
    }
    if (empty($_POST['last_name'])){
        $messages['last_name'] = 'tfgvhj';
    }
    if ($_FILES['image']['error'] !== 0){
        $messages['image'] = 'image obg';
    }
    if ($_FILES['image']['error'] == 0 AND !in_array($my_file_extension, $allowed_extensions)){
        $messages['imageExt'] = 'image obg';
    }
    if (empty($messages)){
        do{
            $new_file_name = md5(rand());
            $destination = '../img/bills/' . $new_file_name . '.' . $my_file_extension;
        } while (file_exists($destination));


        $result = move_uploaded_file( $_FILES['image']['tmp_name'], $destination);


        $query = $db->prepare('INSERT INTO bills (first_name, last_name, image, user_id) VALUES (?, ?, ?, ?)');
        $newBill = $query->execute(
            [
                htmlspecialchars($_POST['first_name']),
                htmlspecialchars($_POST['last_name']),
                $new_file_name . '.' . $my_file_extension,
                $_POST['user_id']
            ]
        );

        if ($newBill){
            $_SESSION['message'] = 'facture ajouté';
            header('location:bills.php');
            exit;
        }
    }


}

if(isset($_POST['update'])) {
    $allowed_extensions = array('pdf');
    $my_file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

    if (empty($_POST['first_name'])) {
        $messages['first_name'] = 'tfgvhj';
    }
    if (empty($_POST['last_name'])) {
        $messages['last_name'] = 'tfgvhj';
    }
    if ($_FILES['image']['error'] !== 0) {
        $messages['image'] = 'image obg';
    }
    if ($_FILES['image']['error'] == 0 AND !in_array($my_file_extension, $allowed_extensions)) {
        $messages['imageExt'] = 'image obg';
    }
    if (empty($messages)) {
                do{
            $new_file_name = md5(rand());
            $destination = '../img/bills/' . $new_file_name . '.' . $my_file_extension;
        } while (file_exists($destination));


        $result = move_uploaded_file( $_FILES['image']['tmp_name'], $destination);


        $query = $db->prepare('UPDATE bills SET first_name = :first_name, last_name = :last_name, image = :image, user_id = : WHERE id = :id');
        $newBill = $query->execute(
            [
                'first_name' => htmlspecialchars($_POST['first_name']),
                'last_name' => htmlspecialchars($_POST['last_name']),
                'image' => $new_file_name . '.' . $my_file_extension,
                'user_id' => $_POST['user_id'],
                'id' => $_POST['id']
            ]
        );

        if ($newBill){
            $_SESSION['message'] = 'facture modifié';
            header('location:bills.php');
            exit;
        }
    }
}

if(isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'edit'){

    $query = $db->prepare('SELECT * FROM bills WHERE id = ?');
    $query->execute(array($_GET['id']));
    //$article contiendra les informations de l'article dont l'id a été envoyé en paramètre d'URL
    $bills = $query->fetch();
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Administration des factures - Melun</title>

    <?php require 'partials/head_assets.php'; ?>

</head>

<body class="index-body">
<div class="container-fluid">

    <?php require 'partials/header.php'; ?>

    <div class="row my-3 index-content">
        <?php require 'partials/nav.php'; ?>

        <section class="col-9">
            <header class="pb-3">
                <h4><?php if(isset($bills)): ?>Modifier<?php else: ?>Ajouter<?php endif; ?> une facture</h4>
            </header>

            <ul class="nav nav-tabs justify-content-center nav-fill" role="tablist">
                <li class="nav-item">
                    <a class="nav-link <?php if(isset($_POST['save']) || isset($_POST['update']) || (!isset($_POST['add_image']) && !isset($_POST['delete_image']))): ?>active<?php endif; ?>" data-toggle="tab" href="#infos" role="tab">Infos</a>
                </li>
                <?php if(isset($bills)): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(isset($_POST['add_image']) || isset($_POST['delete_image'])): ?>active<?php endif; ?>" data-toggle="tab" href="#images" role="tab">Images</a>
                    </li>
                <?php endif; ?>
            </ul>

            <div class="tab-content">
                <div class="tab-pane container-fluid <?php if(isset($_POST['save']) || isset($_POST['update']) || (!isset($_POST['add_image']) && !isset($_POST['delete_image']))): ?>active<?php endif; ?>" id="infos" role="tabpanel">

                    <?php if(isset($message)): //si un message a été généré plus haut, l'afficher ?>
                        <div class="bg-danger text-white">
                            <?= $message; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($_GET['id'])): ?>

                    <form action="bills-form.php?id=<?= $bills['id'];?>&action=edit" method="post" enctype="multipart/form-data">
                        <?php else: ?>
                    <form action="bills-form.php" method="post" enctype="multipart/form-data">
                    <?php endif; ?>
                        <div class="form-group">
                            <label for="title">Prénom</label>
                            <input class="form-control" type="text" name="first_name" id="first_name" />
                        </div>

                        <div class="form-group">
                            <label for="title">Nom</label>
                            <input class="form-control"type="text" name="last_name" id="last_name" />
                        </div>

                        <div class="form-group">
                            <label for="image">Image :</label>
                            <input class="form-control" type="file" name="image" id="image" />
                            <?php if(isset($bills) && $bills['image']): ?>
                                <img class="img-fluid py-4" src="../img/event/<?= $bills['image']; ?>" alt="" />
                                <input type="hidden" name="current-image" value="<?= $bills['image']; ?>" />
                            <?php endif; ?>
                        </div>



                        <div class="form-group">
                            <label for="user_id"> Utilisateur :</label>
                            <select class="form-control" name="user_id" id="user_id">
                                <?php
                                $query = $db->query('SELECT * FROM user');
                                //$article contiendra les informations de l'article dont l'id a été envoyé en paramètre d'URL
                                $users = $query->fetchAll();
                                ?>
                                <?php foreach ($users as $user): ?>
                                <option value="<?= $user['id']; ?>" <?= isset($bills) AND $bills['user_id'] == $user['id'] ? 'selected' : ''; ?>><?= $user['first_name'] . ' ' . $user['last_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="text-right">
                            <?php if(isset($bills)): ?>
                                <input class="btn btn-success" type="submit" name="update" value="Mettre à jour" />
                            <?php else: ?>
                                <input class="btn btn-success" type="submit" name="save" value="Enregistrer" />
                            <?php endif; ?>
                        </div>

                        <?php if(isset($bills)): ?>
                            <input type="hidden" name="id" value="<?= $bills['id']; ?>" />
                        <?php endif; ?>

                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
</body>
</html>
