<?php

require_once '../tools/common.php';

if(!isset($_SESSION['user']) OR $_SESSION['user']['is_admin'] == 0){
    header('location:../index.php');
    exit;
}

if(isset($_POST['save'])){

	$query = $db->prepare('INSERT INTO event (title, content, summary, is_published, created_at) VALUES (?, ?, ?, ?, NOW())');
	$newEvent = $query->execute(
		[
		  htmlspecialchars($_POST['title']),
		  htmlspecialchars($_POST['content']),
		  htmlspecialchars($_POST['summary']),
		  $_POST['is_published']
		]
	);


	$lastInsertedEventId = $db->lastInsertId();

	foreach($_POST['categories'] as $category_id){
		$query = $db->prepare('INSERT INTO event_category (event_id, category_id) VALUES (?, ?)');
		$newEvent = $query->execute([
			$lastInsertedEventId,
			$category_id,
		]);
	}

	if($newEvent){

		if(!empty($_FILES['image']['name'])){

			$allowed_extensions = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
			$my_file_extension = pathinfo( $_FILES['image']['name'] , PATHINFO_EXTENSION);

			if ( in_array($my_file_extension , $allowed_extensions) ){
				$new_file_name = md5(rand());
				$destination = '../img/event/' . $new_file_name . '.' . $my_file_extension;
				$result = move_uploaded_file( $_FILES['image']['tmp_name'], $destination);
				$query = $db->prepare('UPDATE event SET
					image = :image
					WHERE id = :id'
				);

				$resultUpdateImage = $query->execute(
					[
						'image' => $new_file_name . '.' . $my_file_extension,
						'id' => $lastInsertedEventId
					]
				);
			}
		}

		header('location:event-list.php');
		exit;
    }
	else{
		$message = "Impossible d'enregistrer le nouvel event...";
	}
}

if(isset($_POST['update'])){

	$query = $db->prepare('UPDATE event SET
		title = :title,
		content = :content,
		summary = :summary,
		is_published = :is_published
		WHERE id = :id'
	);

	//mise à jour avec les données du formulaire
	$resultEvent = $query->execute([
		'title' => htmlspecialchars($_POST['title']),
		'content' => htmlspecialchars($_POST['content']),
		'summary' => htmlspecialchars($_POST['summary']),
		'is_published' => $_POST['is_published'],
		'id' => $_POST['id'],
	]);

	$query = $db->prepare('DELETE FROM event_category WHERE event_id = ?');
	$result = $query->execute([
		$_POST['id']
	]);

	foreach($_POST['categories'] as $category_id){
		$query = $db->prepare('INSERT INTO event_category (event_id, category_id) VALUES (?, ?)');
		$newEvent = $query->execute([
			  $_POST['id'],
			  $category_id,
		]);
	}

	//si enregistrement ok
	if($resultEvent){
      if(!empty($_FILES['image']['name'])){

            $allowed_extensions = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
            $my_file_extension = pathinfo( $_FILES['image']['name'] , PATHINFO_EXTENSION);

            if ( in_array($my_file_extension , $allowed_extensions) ){
    				if(isset($_POST['current-image'])){
    					unlink('../img/event/' . $_POST['current-image']);
    				}

            $new_file_name = md5(rand());
            $destination = '../img/event/' . $new_file_name . '.' . $my_file_extension;
            $result = move_uploaded_file( $_FILES['image']['tmp_name'], $destination);

            $query = $db->prepare('UPDATE event SET image = :image WHERE id = :id');
            $resultUpdateImage = $query->execute([
	            'image' => $new_file_name . '.' . $my_file_extension,
              'id' => $_POST['id']
				    ]);
          }
      }

      header('location:event-list.php');
      exit;
    }
	else{
		$message = 'Erreur.';
	}
}


//si une image a été soumise
if(isset($_POST['add_image'])){

	$query = $db->prepare('INSERT INTO image (caption, event_id) VALUES (?, ?)');
	$newImage = $query->execute([
		htmlspecialchars($_POST['caption']),
		$_POST['event_id']
	]);

	$lastInsertedImageId = $db->lastInsertId();
	//si enregistrement ok
	if($newImage){
        if(isset($_FILES['image'])){

            $allowed_extensions = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
            $my_file_extension = pathinfo( $_FILES['image']['name'] , PATHINFO_EXTENSION);

            if ( in_array($my_file_extension , $allowed_extensions) ){

                $new_file_name = md5(rand());
                $destination = '../img/event/' . $new_file_name . '.' . $my_file_extension;
                $result = move_uploaded_file( $_FILES['image']['tmp_name'], $destination);

		            //mise à jour de l'image enregistrée avec le nom de fichier généré
                $query = $db->prepare('UPDATE image SET name = :name WHERE id = :id');
                $resultUpdateImage = $query->execute([
			             'name' => $new_file_name . '.' . $my_file_extension,
                   'id' => $lastInsertedImageId
	             ]);
            }
        }

		$imgMessage = "Image ajoutée avec succès !";
    }
}
//suppression d'une image
if(isset($_POST['delete_image'])){
	$query = $db->prepare('SELECT name FROM image WHERE id = ?');
	$query->execute([$_POST['img_id']]);
	$ImgToUnlink = $query->fetch();

	if($ImgToUnlink){

		unlink('../img/event/' . $ImgToUnlink['name']);

		$queryDelete = $db->prepare('DELETE FROM image WHERE id=?');
		$queryDelete->execute([$_POST['img_id']]);

		$imgMessage = "Image Supprimée avec succès !";
	}
}

//si modification event
if(isset($_GET['event_id']) && isset($_GET['action']) && $_GET['action'] == 'edit'){

	$query = $db->prepare('SELECT * FROM event WHERE id = ?');
	$query->execute(array($_GET['event_id']));
	$event = $query->fetch();

	$query = $db->prepare('SELECT category_id FROM event_category WHERE event_id = ?');
	$query->execute(array($_GET['event_id']));
	$eventCategories = $query->fetchAll();

	$query = $db->prepare('SELECT * FROM image WHERE event_id = ?');
	$query->execute(array($_GET['event_id']));
	$eventImages = $query->fetchAll();
}


?>

<!DOCTYPE html>
<html>
	<head>

		<title>Administration des events - Mon premier blog !</title>

		<?php require 'partials/head_assets.php'; ?>

	</head>
    <body class="index-body">
    <div class="container-fluid">

        <?php require 'partials/header.php'; ?>

        <div class="row my-3 index-content">

				<?php require 'partials/nav.php'; ?>

				<section class="col-9">
					<header class="pb-3">
						<h4><?php if(isset($event)): ?>Modifier<?php else: ?>Ajouter<?php endif; ?> un event</h4>
					</header>

					<ul class="nav nav-tabs justify-content-center nav-fill" role="tablist">
						<li class="nav-item">
							<a class="nav-link <?php if(isset($_POST['save']) || isset($_POST['update']) || (!isset($_POST['add_image']) && !isset($_POST['delete_image']))): ?>active<?php endif; ?>" data-toggle="tab" href="#infos" role="tab">Infos</a>
						</li>
						<?php if(isset($event)): ?>
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

							<form action="event-form.php" method="post" enctype="multipart/form-data">

								<div class="form-group">
									<label for="title">Titre :</label>
									<input class="form-control" <?php if(isset($event)): ?>value="<?= htmlentities($event['title']); ?>"<?php endif; ?> type="text" placeholder="Titre" name="title" id="title" />
								</div>
								<div class="form-group">
									<label for="summary">Résumé :</label>
									<input class="form-control" <?php if(isset($event)): ?>value="<?= htmlentities($event['summary']); ?>"<?php endif; ?> type="text" placeholder="Résumé" name="summary" id="summary" />
								</div>
								<div class="form-group">
									<label for="content">Contenu :</label>
                                    <textarea class="form-control" name="content"id="sample"></textarea>
                                </div>
								<div class="form-group">
									<label for="image">Image :</label>
									<input class="form-control" type="file" name="image" id="image" />
									<?php if(isset($event) && $event['image']): ?>
									<img class="img-fluid py-4" src="../img/event/<?= $event['image']; ?>" alt="" />
									<input type="hidden" name="current-image" value="<?= $event['image']; ?>" />
									<?php endif; ?>
								</div>

								<div class="form-group">
									<label for="categories"> Catégorie </label>
									<select class="form-control" name="categories[]" id="categories" multiple="multiple">
										<?php
										$queryCategory= $db ->query('SELECT * FROM category');
										$categories = $queryCategory->fetchAll();
										?>
										<?php foreach($categories as $key => $category) : ?>

											<?php
											$selected = '';

											foreach ($eventCategories as $eventCategorie) {
												if($category['id'] == $eventCategorie['category_id']){
													$selected = 'selected="selected"';
												}
											}
											?>
											<option value="<?= $category['id']; ?>" <?= $selected; ?>> <?= $category['name']; ?> </option>
										<?php endforeach; ?>

									</select>
								</div>

								<div class="form-group">
									<label for="is_published"> Publié ?</label>
									<select class="form-control" name="is_published" id="is_published">
										<option value="0" <?php if(isset($event) && $event['is_published'] == 0): ?>selected<?php endif; ?>>Non</option>
										<option value="1" <?php if(isset($event) && $event['is_published'] == 1): ?>selected<?php endif; ?>>Oui</option>
									</select>
								</div>

								<div class="text-right">
								<?php if(isset($event)): ?>
								<input class="btn btn-success" type="submit" name="update" value="Mettre à jour" />
								<?php else: ?>
								<input class="btn btn-success" type="submit" name="save" value="Enregistrer" />
								<?php endif; ?>
								</div>

								<?php if(isset($event)): ?>
								<input type="hidden" name="id" value="<?= $event['id']; ?>" />
								<?php endif; ?>

							</form>
						</div>
						<?php if(isset($event)): ?>
						<div class="tab-pane container-fluid <?php if(isset($_POST['add_image']) || isset($_POST['delete_image'])): ?>active<?php endif; ?>" id="images" role="tabpanel">


							<?php if(isset($imgMessage)): ?>
							<div class="bg-success text-white p-2 my-4">
								<?= $imgMessage; ?>
							</div>
							<?php endif; ?>

							<h5 class="mt-4"><?php if(isset($image)): ?>Modifier<?php else: ?>Ajouter<?php endif; ?> une image :</h5>

							<form action="event-form.php?event_id=<?= $event['id']; ?>&action=edit" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="caption">Légende :</label>
									<input class="form-control" type="text" placeholder="Légende" name="caption" id="caption" />
								</div>

								<div class="form-group">
									<label for="image">Fichier :</label>
									<input class="form-control" type="file" name="image" id="image" />
								</div>

								<input type="hidden" name="event_id" value="<?= $event['id']; ?>" />

								<div class="text-right">
									<input class="btn btn-success" type="submit" name="add_image" value="Enregistrer" />
								</div>
							</form>

							<div class="row">
								<h5 class="col-12 pb-4">Liste des images :</h5>
								<?php foreach($eventImages as $image): ?>
								<form action="event-form.php?event_id=<?= $event['id']; ?>&action=edit" method="post" class="col-4 my-3">
									<img src="../img/event/<?= $image['name']; ?>" alt="" class="img-fluid" />
									<p class="my-2"><?= $image['caption']; ?></p>
									<input type="hidden" name="img_id" value="<?= $image['id']; ?>" />
									<div class="text-right"><input class="btn btn-danger" type="submit" name="delete_image" value="Supprimer" /></div>
								</form>
								<?php endforeach; ?>
							</div>
						</div>
						<?php endif; ?>
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
