<?php

require_once '../tools/common.php';

if(!isset($_SESSION['user']) OR $_SESSION['user']['is_admin'] == 0){
    header('location:../index.php');
    exit;
}

//supprimer la catégorie dont l'ID est envoyé en paramètre URL
if(isset($_GET['category_id']) && isset($_GET['action']) && $_GET['action'] == 'delete'){

	$query = $db->prepare('DELETE FROM category WHERE id = ?');
	$result = $query->execute(
		[
			$_GET['category_id']
		]
	);
	//générer un message à afficher plus bas pour l'administrateur
	if($result){
		$message = "Suppression efféctuée.";
	}
	else{
		$message = "Impossible de supprimer la séléction.";
	}
}

//séléctionner toutes les catégories pour affichage de la liste
$query = $db->query('SELECT * FROM category');
$categories = $query->fetchall();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Administration des catégories - Melun</title>
		<?php require 'partials/head_assets.php'; ?>
	</head>
	<body class="index-body">
		<div class="container-fluid">

			<?php require 'partials/header.php'; ?>

			<div class="row my-3 index-content">

				<?php require 'partials/nav.php'; ?>

				<section class="col-9">
					<header class="pb-4 d-flex justify-content-between">
						<h4>Liste des catégories</h4>
						<a class="btn btn-primary" href="category-form.php">Ajouter une catégorie</a>
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
								<th>Name</th>
								<th>Description</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>

							<?php if($categories): ?>
							<?php foreach($categories as $category): ?>

							<tr>
								<th><?= htmlentities($category['id']); ?></th>
								<td><?= htmlentities($category['name']); ?></td>
								<td><?= htmlentities($category['description']); ?></td>
								<td>
									<a href="category-form.php?category_id=<?= $category['id']; ?>&action=edit" class="btn btn-warning">Modifier</a>
									<a onclick="return confirm('Are you sure?')" href="category-list.php?category_id=<?= $category['id']; ?>&action=delete" class="btn btn-danger">Supprimer</a>
								</td>
							</tr>

							<?php endforeach; ?>
							<?php else: ?>
								Aucune catégorie enregistré.
							<?php endif; ?>

						</tbody>
					</table>

				</section>

			</div>

		</div>
	</body>
</html>
