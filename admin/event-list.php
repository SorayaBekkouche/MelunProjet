<?php

require_once '../tools/common.php';

if(!isset($_SESSION['user']) OR $_SESSION['user']['is_admin'] == 0){
    header('location:../index.php');
    exit;
}

//supprimer l'event dont l'ID est envoyé en paramètre URL
if(isset($_GET['event_id']) && isset($_GET['action']) && $_GET['action'] == 'delete'){

	$query = $db->prepare('SELECT image FROM event WHERE id = ?');
	$query->execute(array($_GET['event_id']));
	$imageToDelete = $query->fetchColumn();

	if($imageToDelete){
		unlink('../img/event/' . $imageToDelete["image"]);
	}

	$query = $db->prepare('DELETE FROM event_category WHERE event_id = ?');
	$result = $query->execute(
		[
			$_GET['event_id']
		]
	);

	$query = $db->prepare('DELETE FROM event WHERE id = ?');
	$result = $query->execute(
		[
			$_GET['event_id']
		]
	);
	if($result){
		$message = "Suppression efféctuée.";
	}
	else{
		$message = "Impossible de supprimer la séléction.";
	}
}

$query = $db->query('SELECT * FROM event ORDER BY id DESC');
$events = $query->fetchall();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Administration des events - Melun</title>
		<?php require 'partials/head_assets.php'; ?>
	</head>
	<body class="index-body">
		<div class="container-fluid">
            <?php require 'partials/header.php'; ?>

			<div class="row my-3 index-content">

				<?php require 'partials/nav.php'; ?>

				<section class="col-9">
					<header class="pb-4 d-flex justify-content-between">
						<h4>Liste des events</h4>
						<a class="btn btn-primary" href="event-form.php">Ajouter un event</a>
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
								<th>Publié</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>

							<?php if($events): ?>
							<?php foreach($events as $event): ?>

							<tr>
								<th><?= htmlentities($event['id']); ?></th>
								<td><?= htmlentities($event['title']); ?></td>
								<td>
									<?php if($event['is_published'] == 1): ?>
									Oui
									<?php else: ?>
									Non
									<?php endif; ?>
								</td>
								<td>
									<a href="event-form.php?event_id=<?= $event['id']; ?>&action=edit" class="btn btn-warning">Modifier</a>
									<a onclick="return confirm('Are you sure?')" href="event-list.php?event_id=<?= $event['id']; ?>&action=delete" class="btn btn-danger">Supprimer</a>
								</td>
							</tr>

							<?php endforeach; ?>
							<?php else: ?>
								Aucun event enregistré.
							<?php endif; ?>

						</tbody>
					</table>

				</section>

			</div>

		</div>
	</body>
</html>
