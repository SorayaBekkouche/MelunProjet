<?php

require_once 'tools/common.php';
header("Access-Control-Allow-Origin: *");

if(isset($_GET['category_id']) ){

    $query = $db->prepare('SELECT * FROM category WHERE id = ?');
    $query->execute( array($_GET['category_id']) );

    $currentCategory = $query->fetch();

    if($currentCategory){
        $query = $db->prepare('
			SELECT event.*
			FROM event
			JOIN event_category ON event.id = event_category.event_id 
			JOIN category ON event_category.category_id = category.id
			WHERE event.is_published = 1 AND category.id = ?
			GROUP BY event.id
			ORDER BY created_at DESC
		');

        $result = $query->execute( array($_GET['category_id']) );
        $events = $query->fetchAll();
    }
    else{
        header('location:index.php');
        exit;
    }
}
else{
    $query = $db->query('
		SELECT event.*, GROUP_CONCAT(category.name SEPARATOR " / ") AS categories
		FROM event
		JOIN event_category ON event.id = event_category.event_id 
		JOIN category ON event_category.category_id = category.id
		WHERE event.is_published = 1
		GROUP BY event.id
		ORDER BY created_at DESC'
    );
    $events = $query->fetchAll();
}

if(isset($_POST['datePicker'])) {

    $queryEvents = $db->prepare('SELECT * FROM event WHERE created_at = ?' );
    $queryEvents->execute(array($_POST['datePicker']));
    $getEvents = $queryEvents->fetchAll();



}
else{
    $queryEvents = $db->query('SELECT * FROM event ' );
    $getEvents = $queryEvents->fetchAll();

}

?>

<!DOCTYPE html>
<html>
 <head>
	<title><?php if(isset($currentCategory)): ?><?= $currentCategory['name']; ?><?php else : ?>Tous les évènements<?php endif; ?> - Melun</title>
     <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">


     <?php require 'partials/head_assets.php'; ?>
 </head>
 <body>
	<div>
		
		<div>

			<?php require('partials/nav.php'); ?>
            <main>
            <h1><span class="verticalLine">|</span> <?php if(isset($currentCategory)): ?><?= $currentCategory['name']; ?><?php else : ?>Que faire à Melun<?php endif; ?></h1>

				<section class="all_aricles">
                    <div style="display: flex; flex-direction: row; align-items: center; ">
                        <div style="width: 100%; padding-right: 5%;">
                            <form class="datepicker" method="post">
                                <p>Sélectionnez une date :</p>
                                <input type="date" name="datePicker">
                                <input type="submit" name="sendDate" id="sendDate">
                            </form>


                        </div>

                        <br>
                        <br>
                        <br>
                        <div>


                            <div style="width: 100%; padding-left: 5%;">
                                <h2>FOCUS</h2>
                                <?php foreach ($getEvents as $Event): ?>
                                <h3><?= $Event['title']; ?></h3>
                                <p><?= $Event['summary']; ?></p>
                                <p><?= $Event['content']; ?></p>
                                <?php endforeach; ?>
                            </div>

                        </div>
                    </div>

                    <br>
                    <br>
                    <hr>
					<?php if(!empty($events)): ?>
						<?php foreach($events as $key => $event): ?>
						<article>
							<h2 class="h3"><?= $event['title']; ?></h2>
							<div>
								<div>
									<img class="img-fluid" src="img/event/<?= $event['image']; ?>" alt="<?= $event['title']; ?>" />
								</div>

								<div class=" <?php if(!empty($event['image'])): ?> <?php endif; ?>">

									<?php if(!isset($currentCategory)): ?>
									<span class="article-date">Créé le <?= strftime("%A %e %B %Y", strtotime($event['created_at'])); ?></span> - <b>[<?= $event['categories']; ?>]</b>
                                    <?php endif; ?>
									<div class="article-content">
										<?= $event['summary']; ?>
									</div>
									<a href="event.php?event_id=<?= $event['id']; ?>">> Lire davantage</a>
								</div>
							</div>
                        </article>
						<?php endforeach; ?>
					<?php else: ?>

						Aucun event dans cette catégorie...
					<?php endif; ?>

				</section>
			</main>
			
		</div>
		
		<?php require 'partials/footer.php'; ?>
		
	</div>
 </body>
</html>