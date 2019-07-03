<?php

require_once 'tools/common.php';
header("Access-Control-Allow-Origin: *");


if(isset($_GET['event_id'] ) ){

	//selection de l'event dont l'ID est envoyé en paramètre GET
	$query = $db->prepare('
		SELECT event.*, GROUP_CONCAT(category.name SEPARATOR " / ") AS categories
		FROM event
		JOIN event_category ON event.id = event_category.event_id 
		JOIN category ON event_category.category_id = category.id
		WHERE event.id = ? AND event.is_published = 1
	');
	
	$query->execute( array( $_GET['event_id'] ) );
	
	$event = $query->fetch();
	
	//si pas d'event trouvé dans la base de données, renvoyer l'utilisateur vers la page index
	if(!$event['id']){
		header('location:index.php');
		exit;
	}
	
	//récupération des images
	
	$query = $db->prepare('
		SELECT image.*
		FROM image
		JOIN event ON image.event_id = event.id 
		WHERE event.id = ?
		ORDER BY image.id DESC
	');
	$query->execute( array( $_GET['event_id'] ) );
	
	$images = $query->fetchAll();
}
else{ //si event_id n'est pas envoyé en URL, renvoyer l'utilisateur vers la page index
	header('location:index.php');
	exit;
}
?>

<!DOCTYPE html>
<html>
 <head>

	<title><?= $event['title']; ?> - Mon premier blog !</title>

   <?php require 'partials/head_assets.php'; ?>

 </head>
 <body >
	<div>


		<div >

			<?php require 'partials/nav.php'; ?>

			<main class="">
                <div class="text-right">
                    <a href="event-list.php">> Tous les évènements</a>
                </div>
                <h1><span class="verticalLine">|</span><?= $event['title']; ?></h1>
                <article>
					<?php if(!empty($event['image'])): ?>

					<img src="img/event/<?= $event['image']; ?>" alt="<?= $event['title']; ?>" />
					<?php endif; ?>
					<b class=" ">[<?= $event['categories']; ?>]</b>
					<span class=" ">Créé le <?= strftime("%A %e %B %Y", strtotime($event['created_at'])); ?></span>
                    <br>
                    <br>
					<div class=" ">
						<?= $event['content']; ?>
					</div>
                    <br>
                    <br>
                    <br>
                    <br>
				
				<div class="">
				<?php foreach ($images as $image): ?>
				<a class=" " data-fancybox="gallery" data-caption="<?= $image['caption']; ?>" href="img/event/<?= $image['name']; ?>">
					<img class=" " src="img/event/<?= $image['name']; ?>" alt="<?= $image['caption']; ?>" />
				</a>
				<?php endforeach; ?>
				</div>

                </article>
			</main>

		</div>

		<?php require 'partials/footer.php'; ?>

	</div>
 </body>
</html>
