<?php
require_once '../tools/common.php';

if(!isset($_SESSION['user']) OR $_SESSION['user']['is_admin'] == 0){
    header('location:../index.php');
    exit;
}
$password = 'fjdskfdsk';
$messages = [];
if(isset($_POST['save'])) {

    if (empty($_POST['first_name'])) {
        $messages['first_name'] = 'tfgvhj';
    }
    if (empty($_POST['last_name'])) {
        $messages['last_name'] = 'tfgvhj';
    }
    if (empty($_POST['email'])) {
        $messages['email'] = 'tfgvhj';
    }
    if (empty($_POST['address'])) {
        $messages['address'] = 'tfgvhj';
    }
    if (empty($messages)) {
        $query = $db->prepare('INSERT INTO user (first_name, last_name, password, email, address, is_admin) VALUES (?, ?, ?, ?, ?, ?)');
        $newUser = $query->execute(
            [
                htmlspecialchars($_POST['first_name']),
                htmlspecialchars($_POST['last_name']),
                md5($password),
                htmlspecialchars($_POST['email']),
                htmlspecialchars($_POST['address']),
                $_POST['is_admin']
            ]
        );

        if ($newUser) {
            $_SESSION['message'] = 'Question ajoutée';
            header('location:user-list.php');
            exit;
        }
    }
}


if(isset($_POST['update'])) {

    if (empty($_POST['first_name'])) {
        $messages['first_name'] = 'prenom';
    }
    if (empty($_POST['last_name'])) {
        $messages['last_name'] = 'nom';
    }
    if (empty($_POST['email'])) {
        $messages['email'] = 'email';
    }
    if (empty($_POST['is_admin'])) {
        $messages['is_admin'] = 'admin';
    }
    if (empty($_POST['address'])) {
        $messages['address'] = 'adress';
    }
    if (empty($messages)) {

        $query = $db->prepare('UPDATE user SET first_name = :first_name, last_name = :last_name, email = :email, password = :password, address= :address, is_admin = :is_admin WHERE id = :id');
        $result = $query->execute([
            'first_name' => htmlspecialchars($_POST['first_name']),
            'last_name' => htmlspecialchars($_POST['last_name']),
            'email' => htmlspecialchars($_POST['email']),
            'address' => htmlspecialchars($_POST['address']),
            'password' => $password,
            'is_admin' => $_POST['is_admin'],
            'id' => $_POST['id']
        ]);


        if ($result) {
            header('location:user-list.php');
            exit;
        } else {
            $message = 'Erreur.';
        }
    }
}

if(isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'edit'){

	$query = $db->prepare('SELECT * FROM user WHERE id = ?');
    $query->execute(array($_GET['id']));
	$user = $query->fetch();
}

?>

<!DOCTYPE html>
<html>
	<head>

		<title>Administration des utilisateurs</title>

		<?php require 'partials/head_assets.php'; ?>

	</head>
	<body class="index-body">
		<div class="container-fluid">

			<?php require 'partials/header.php'; ?>

			<div class="row my-3 index-content">

				<?php require 'partials/nav.php'; ?>

				<section class="col-9">
					<header class="pb-3">

						<h4><?php if(isset($user)): ?>Modifier<?php else: ?>Ajouter<?php endif; ?> un utilisateur</h4>
					</header>

					<?php if(isset($message)): ?>
					<div class="bg-danger text-white">
						<?= $message; ?>
					</div>
					<?php endif; ?>

                    <?php if (isset($_GET['id'])): ?>
                    <form action="user-form.php?id=<?= $user['id'];?>&action=edit" method="post" enctype="multipart/form-data">
                        <?php else: ?>
                        <form action="user-form.php" method="post" enctype="multipart/form-data">
                            <?php endif; ?>
						<div class="form-group">
							<label for="first_name">Prénom :</label>
							<input class="form-control" <?php if(isset($user)): ?>value="<?= $user['first_name']?>"<?php endif; ?> type="text"  name="first_name" id="first_name" />
						</div>
						<div class="form-group">
							<label for="last_name">Nom de famille : </label>
							<input class="form-control" <?php if(isset($user)): ?>value="<?= $user['last_name']?>"<?php endif; ?> type="text" name="last_name" id="last_name" />
						</div>
						<div class="form-group">
							<label for="email">Email :</label>
							<input class="form-control" <?php if(isset($user)): ?>value="<?= $user['email']?>"<?php endif; ?> type="email" name="email" id="email" />
						</div>
                            <div class="form-group">
                                <label for="address">Adresse :</label>
                                <input class="form-control" <?php if(isset($user)): ?>value="<?= $user['address']?>"<?php endif; ?> type="text" name="address" id="address" />
                            </div>

						<div class="form-group">
							<label for="is_admin"> Admin ?</label>
							<select class="form-control" name="is_admin" id="is_admin">
								<option value="0" <?php if(isset($user) && $user['is_admin'] == 0): ?>selected<?php endif; ?>>Non</option>
								<option value="1" <?php if(isset($user) && $user['is_admin'] == 1): ?>selected<?php endif; ?>>Oui</option>
							</select>
						</div>
						
						<div class="text-right">
							<?php if(isset($user)): ?>
							<input class="btn btn-success" type="submit" name="update" value="Mettre à jour" />
							<?php else: ?>
							<input class="btn btn-success" type="submit" name="save" value="Enregistrer" />
							<?php endif; ?>
						</div>

						<?php if(isset($user)): ?>
						<input type="hidden" name="id" value="<?= $user['id']?>" />
						<?php endif; ?>

					</form>
				</section>
			</div>

		</div>
	</body>
</html>
