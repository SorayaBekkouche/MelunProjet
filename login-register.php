<?php

require_once 'tools/common.php';

//en cas de connexion
if(isset($_POST['login'])){
    if(empty($_POST['email']) OR empty($_POST['password'])){
        $loginMessage = "Merci de remplir tous les champs";
    }
    else{
        $query = $db->prepare('SELECT * FROM user	WHERE email = ? AND password = ?');
        $query->execute( array( $_POST['email'], hash('md5', $_POST['password']), ) );
        $user = $query->fetch();

        if($user){
            $_SESSION['user']['is_admin'] = $user['is_admin'];
            $_SESSION['user']['first_connection'] = $user['first_connection'];
            $_SESSION['user']['first_name'] = $user['first_name'];
            $_SESSION['user']['id'] = $user['id'];
        }
        else{
            $loginMessage = "Mauvais identifiants";
        }
    }
}

if(isset($_SESSION['user'])){
    header('location:index.php');
    exit;
}


?>
<!DOCTYPE html>
<html>
<head>

    <title>Melun  - Login</title>

    <?php require 'partials/head_assets.php'; ?>

</head>
<body>
<div>

    <div>

        <?php require 'partials/nav.php'; ?>

        <main>
        <div style="display: flex; flex-direction: row;">
            <div class="welcomeDiv">
                <p>Bienvenue sur votre Espace personnel.</p>
            </div>

            <article class="signUp" style="margin-left: 20%">

                <div class="outsideForm">
                    <div class="<?php if(isset($_POST['login']) || !isset($_POST['register'])): ?>active<?php endif; ?>" id="login" role="tabpanel">

                        <form class="insideForm" action="login-register.php" method="post">

                            <?php if(isset($loginMessage)): ?>
                                <div><?= $loginMessage; ?></div>
                            <?php endif; ?>

                            <h4>Connectez-vous à votre compte</h4>



                            <div>
                                <label for="email"><br><br>Email</label>
                                <input class="textInsideForm" value="" type="email" name="email" id="email" />
                            </div>

                            <div>
                                <label for="password"><br><br>Mot de passe</label>
                                <input class="textInsideForm" type="password" name="password" id="password" />
                            </div>
                            <!-- <p><a href="" id="forgottenPassw">Mot de passe oublié ?</a></p><br> -->
                            <div >
                                <input class="sendBtn" type="submit" name="login" value="Valider" href="first-connection.php"/>
                                <?php if(isset($_SESSION['user'])): ?>

                                        <?php if($_SESSION['user']['first_connection'] == 1): ?>
                                        <input class="sendBtn" type="submit" name="login" value="Valider" href="first-connection.php"/>
                                        <?php else: ?>
                                            <input class="sendBtn" type="submit" name="login" value="Valider" href="user-profile.php"/>
                                        <?php endif; ?>


                                    <?php endif; ?>



                            </div>


                        </form>

                    </div>

                </div>

            </article>
        </main>

    </div>

    <?php require 'partials/footer.php'; ?>

</div>
</body>
</html>
