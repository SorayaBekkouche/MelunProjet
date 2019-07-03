<?php

require_once 'tools/common.php';


$getFirstCo = $db->prepare('SELECT * FROM user WHERE id = ?');
$getFirstCo->execute(array($_SESSION['id']));
$user = $getFirstCo->fetch();

if (isset($_POST['check'])) {
    $check = $db->prepare('UPDATE user SET first_connection = ? WHERE id = ?');
    $check->execute(array($_POST['check'], $_SESSION['id']));

    if ($check){
        $_SESSION['user']['first_connection'] = 1;
        header('location:first-connection.php');
        exit;
    }
}

if (isset($_SESSION['id']['first_connection']) AND $_SESSION['id']['first_connection'] == 1){
    header('location:first-connection.php');
    exit;
}

?>


<!DOCTYPE html>
<html>
<head>

    <title>Melun - Espace personnel</title>

    <?php require 'partials/head_assets.php'; ?>

</head>
<body>


<?php require 'partials/nav.php'; ?>

            <article style="width: 80%; margin-left: auto; margin-right: auto;">

                <div class="">


                    <?php if(isset($registerMessage)): ?>
                        <div class="text-danger col-sm-8 offset-sm-2 mb-4"><?= $registerMessage; ?></div>
                    <?php endif; ?>

                    <form action="" method="post" class="insideForm">
                        <h4>Validation des informations</h4>
                        <label for="email"><br><br>Email</label>
                        <input type="text" class="textInsideForm" value="<?= $user['lastname']; ?>" name="email" id="email" class="textInsideForm"/><br>

                        <label for="last_name"><br><br>Nom</label>
                        <input type="text" value="<?php if(isset($_POST['first_name'])) { echo $_POST['first_name']; } ?>" name="first_name" id="first_name" class="textInsideForm"/><br>

                        <label for="first_name"><br><br>Prénom</label>
                        <input type="text" type="text" value="<?php if(isset($_POST['last_name'])) { echo $_POST['last_name']; } ?>" name="last_name" id="last_name" class="textInsideForm"/><br>

                        <label for="address"><br><br>Adresse</label>
                        <input type="text" name="address" value="<?php if(isset($_POST['address'])) { echo $_POST['address']; } ?>" class="textInsideForm"/>


                        <a href="signalement.php"><input class="pbBtn" type="submit" name="sgnl" value="Problème"/></a>
                        <a href="user-profile.php"><input class="confirmBtn" type="submit" name="register" value="Valider" /></a>

                    </form>


                </div>
            </article>

    <?php require 'partials/footer.php'; ?>


</body>
</html>


    <?php
    if(isset($error))
    {
        echo '<font color="red">'.$error."</font>";
    }
    ?>
</div>


