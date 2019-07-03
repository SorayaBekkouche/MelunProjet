<?php
require_once '../tools/common.php';

if(!isset($_SESSION['user']) OR $_SESSION['user']['is_admin'] == 0){
    header('location:../index.php');
    exit;
}


if(isset($_POST['save'])){
    $query = $db->prepare('INSERT INTO category (name, description, image) VALUES (?, ?, ?)');
    $newCategory = $query->execute(
		[
			htmlspecialchars($_POST['name']),
			htmlspecialchars($_POST['description']),
            htmlspecialchars($_POST['image']),
		]
    );
	
    if($newCategory){
        if(isset($_FILES['image'])){

            $allowed_extensions = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
            $my_file_extension = pathinfo( $_FILES['image']['name'] , PATHINFO_EXTENSION);
			
            if ( in_array($my_file_extension , $allowed_extensions) ){

                $new_file_name = md5(rand());
                $destination = '../img/category/' . $new_file_name . '.' . $my_file_extension;
                $result = move_uploaded_file( $_FILES['image']['tmp_name'], $destination);
                $lastInsertedCategoryId = $db->lastInsertId();

                $query = $db->prepare('UPDATE category SET
					image = :image
					WHERE id = :id'
                );
                $resultUpdateImage = $query->execute(
                    [
                        'image' => $new_file_name . '.' . $my_file_extension,
                        'id' => $lastInsertedCategoryId
                    ]
                );
            }
        }

        header('location:category-list.php');
        exit;
    }
    else {
        $message = "Impossible d'enregistrer la nouvelle categorie...";
    }
}


if(isset($_POST['update'])){

	$query = $db->prepare('UPDATE category SET
		name = :name,
		description = :description
		WHERE id = :id'
	);


	$result = $query->execute(
		[
			'description' => $_POST['description'],
			'name' => $_POST['name'],
			'id' => $_POST['id']
		]
	);
	
	if($result){
        if(isset($_FILES['image'])){

            $allowed_extensions = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
            $my_file_extension = pathinfo( $_FILES['image']['name'] , PATHINFO_EXTENSION);
			
            if ( in_array($my_file_extension , $allowed_extensions) ){
				if(isset($_POST['current-image'])){
					unlink('../img/category/' . $_POST['current-image']);
				}

                $new_file_name = md5(rand());
                $destination = '../img/category/' . $new_file_name . '.' . $my_file_extension;
                $result = move_uploaded_file( $_FILES['image']['tmp_name'], $destination);

                $query = $db->prepare('UPDATE category SET
					image = :image
					WHERE id = :id'
                );
                $resultUpdateImage = $query->execute(
                    [
                        'image' => $new_file_name . '.' . $my_file_extension,
                        'id' => $_POST['id']
                    ]
                );
            }
        }

        header('location:category-list.php');
        exit;
    }
    else {
        $message = "Impossible d'enregistrer la nouvelle categorie...";
    }
}

if(isset($_GET['category_id']) && isset($_GET['action']) && $_GET['action'] == 'edit'){

	$query = $db->prepare('SELECT * FROM category WHERE id = ?');
    $query->execute(array($_GET['category_id']));
    $category = $query->fetch();
}

?>

<!DOCTYPE html>
<html>
	<head>

		<title>Administration des catégories - Mon premier blog !</title>

		<?php require 'partials/head_assets.php'; ?>

	</head>
    <body class="index-body">
    <div class="container-fluid">

        <?php require 'partials/header.php'; ?>

        <div class="row my-3 index-content">

				<?php require 'partials/nav.php'; ?>

				<section class="col-9">
					<header class="pb-3">
						<h4><?php if(isset($category)): ?>Modifier<?php else: ?>Ajouter<?php endif; ?> une catégorie</h4>
					</header>

					<?php if(isset($message)): //si un message a été généré plus haut, l'afficher ?>
					<div class="bg-danger text-white">
						<?= $message; ?>
					</div>
					<?php endif; ?>

					
					<form action="category-form.php" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="name">Nom :</label>
							<input class="form-control" <?php if(isset($category)): ?>value="<?= htmlentities($category['name']); ?>"<?php endif; ?> type="text" placeholder="Nom" name="name" id="name" />
						</div>
						<div class="form-group">
							<label for="description">Description : </label>
                            <textarea class="form-control" name="content"id="sample" name="description"></textarea>
                        </div>
						
						<div class="form-group">
							<label for="image">Image :</label>
							<input class="form-control" type="file" name="image" id="image" />
							<?php if(isset($category) && $category['image']): ?>
							<img class="img-fluid py-4" src="../img/category/<?= $category['image']; ?>" alt="" />
							<input type="hidden" name="current-image" value="<?= $category['image']; ?>" />
							<?php endif; ?>
						</div>
						
						<div class="text-right">
							<?php if(isset($category)): ?>
							<input class="btn btn-success" type="submit" name="update" value="Mettre à jour" />
							<!-- Sinon on afficher un lien d'enregistrement d'une nouvelle catégorie -->
							<?php else: ?>
							<input class="btn btn-success" type="submit" name="save" value="Enregistrer" />
							<?php endif; ?>
						</div>

						<?php if(isset($category)): ?>
						<input type="hidden" name="id" value="<?= $category['id']?>" />
						<?php endif; ?>

					</form>
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
