<?php
require_once 'tools/common.php';
if(isset($_SESSION['user']) AND isset($_GET['logout'])){
	unset($_SESSION["user"]);
}
?>

<!DOCTYPE html>
<html lang="fr">
	<head>

		<title>Melun</title>

		<?php require 'partials/head_assets.php'; ?>
    </head>
	<body>
                <?php require_once('partials/nav.php'); ?>
                <div id="caroussel" class="banner"
                     data-height="600"
                     data-width="100%"
                     data-slide-speed="900"
                     data-autoslide="5000">
                    <img src="img/services/48hBD.png" class="slider">
                    <img src="img/services/ic_large_w900h600q100_desfemmesetdesmots.jpg" class="slider">
                    <img src="img/services/thumbnail_820x679.jpg" class="slider">
                    <img src="img/services/ic_large_w900h600q100_img-20180916-165244.jpg" class="slider">

                    <div class="previous" data-previous-cursor="left.png"></div>
                    <div class="next" data-next-cursor="right.png"></div>

                    <div class="links">
                        <a href="1"></a>
                        <a href="2"></a>
                        <a href="3"></a>
                        <a href="4"></a>
                    </div>
                </div>

				<main>
					<section class="latest_articles">
                        <h1><span class="verticalLine">|</span> A la une</h1>

                        <article>
						<?php
						$query = $db->query('
							SELECT event.*, GROUP_CONCAT(category.name SEPARATOR " / ") AS categories
							FROM event
							JOIN event_category ON event.id = event_category.event_id 
							JOIN category ON category.id = event_category.category_id 
							WHERE event.is_published = 1
							GROUP BY event.id
							ORDER BY created_at DESC
							LIMIT 0, 3'
						);
						?>

						<?php while($event = $query->fetch()): ?>

							<h2><?= $event['title']; ?></h2>
							<div>
								<?php if(!empty($event['image'])): ?>
								<div
									<img src="img/event/<?= $event['image']; ?>" alt="<?= $event['title']; ?>" />
								</div>
								<?php endif; ?>
								<div class="<?php if(!empty($event['image'])): ?><?php endif; ?>">
									<b class="article-category">[<?= $event['categories']; ?>]</b>
									<span class="article-date">Créé le <?= strftime("%A %e %B %Y", strtotime($event['created_at'])); ?></span>
									<div class="article-content">
										<?= $event['summary']; ?>
									</div>
									<a href="event.php?event_id=<?= $event['id']; ?>">> Plus d'informations</a>
								</div>
							</div>
                            <br>
                            <br>
                            <br>


						<?php endwhile; ?>

						<?php $query->closeCursor(); ?>
                        </article>
                        <div class="text-right">
                            <a href="event-list.php">> Tous les évènements</a>
                        </div>

                    </section>


                        <section>
                            <h1><span class="verticalLine">|</span> Votre ville</h1>
                            <article >
                                <h2>Une ville médiévale</h2>
                                <p>Melun est dès l’époque romaine située à la convergence d’axes fluviaux et terrestres. Metlosedum ou Melodunum occupe très tôt la partie sud de la ville actuelle ainsi que l’île, choisie pour sa situation dans un méandre de la Seine. Alors territoire des Sénons, elle est rattachée au Moyen Âge au diocèse de Sens. Les Capétiens renforcent le caractère défensif de l’île en y établissant le château royal au Xème siècle.</p>
                                <p>La Renaissance voit la reconstruction partielle ou totale des églises et fortifications, ainsi que l’abandon progressif du château comme résidence des rois de France. Cinq monastères prennent place dans la ville du XIVème au XVIIème siècle. Le rôle de Melun pour l’approvisionnement de Paris en farine ne fait que s’accroître du Moyen Âge à l’époque moderne, tout comme son rôle administratif.</p>
                                <p>La ligne de chemin de fer Paris-Lyon-Marseille tracée à partir de 1847 fixe à nouveau la population dans le sud de la ville, avec l’apparition d’industries telles que la Brasserie Grüber en 1880, ou la Coopération Pharmaceutique Française (Cooper) en 1910. Une présence militaire se perpétue dans l’histoire de la ville. Des caserne s’installent au XVIIIème siècle et accueillent successivement hussards, dragons et mameluks. L’Ecole des Officiers de la Gendarmerie Nationale est implantée à Melun depuis 1945.</p>
                                <p>Ville de commerces dont l’activité principale est désormais liée aux services, Melun est le siège de la Préfecture depuis 1800. La ville a également accueilli d’illustres figures, telles que Abélard, Jacques Amyot (maison natale), Louis Pasteur, ou Paul Cézanne (Le Pont de Maincy, Paysage…).</p>
                            </article>
                            <h1><span class="verticalLine">|</span> Services</h1>
                            <article>
                                <p>Le Maire est le chef des services municipaux qui sont responsables de la mise en oeuvre des politiques votées par les élus. En conséquence, leurs compétences et leur organisation doivent être constamment en phase avec cette exigence. Ils assurent l’ensemble des services à la population dont la Ville est chargée dans le cadre des compétences que la loi lui attribue, mais aussi de celles qu’elle a choisies d’assurer. Organisés en plusieurs directions, ils sont dirigés par le Directeur Général des Services qui oriente, supervise et coordonne leurs activités.</p>
                                <p>Bienvenue dans les coulisses de votre Mairie. Les services municipaux sont à votre disposition pour toute action relevant de la compétence communale. Ils pourront également vous orienter dans vos relations avec les autres administrations.</p><br><br>

                                <div class="services">
                                    <div><h4>médiathèques</h4><br>
                                        <a href="mediatheques.php"><img src="img/services/mediatheque.jpg" width="320" height="225" class="modalOpenBtn"></a>
                                    </div>
                                    <div><h4>musées</h4><br>
                                        <a href="musees.php"><img src="img/services/musee.png" width="320" height="225"></a></div>
                                    <div><br><h4>cinémas</h4><br>
                                        <a href="cinema.php"><img src="img/services/cinema.jpeg" width="320" height="225"></a></div>
                                    <div><br><h4>piscine</h4><br>
                                        <a href="piscines.php"><img src="img/services/piscine.jpeg" width="320" height="225"></a></div>
                                    <div><br><h4>écoles</h4><br>
                                        <a href="ecoles.php"><img src="img/services/ecole.jpg" width="320" height="225"></a></div>
                                    <div><br><h4>mairie</h4><br>
                                        <a href="mairie.php"><img src="img/services/mairie.jpg" width="320" height="225"></a></div>
                                    <div><br><h4>centres hospitaliers</h4><br>
                                        <a href="hopitaux.php"><img src="img/services/hopital.jpg" width="320" height="225"></a></div>
                                </div>
                                <br>
                                <br>
                                <ul class="servicesSmall">
                                    <li><a href="mediatheques.php">Médiathèques</a></li>
                                    <li><a href="musees.php">Musées</a></li>
                                    <li><a href="cinemas.php">Cinémas</a></li>
                                    <li><a href="piscines.php">Piscines</a></li>
                                    <li><a href="ecoles.php">Ecoles</a></li>
                                    <li><a href="mairie.php">Mairie</a></li>
                                    <li><a href="hopitaux">Centres hospitaliers</a></li>
                                </ul>
                            </article>
                        </section>
                    </main>

			<?php require 'partials/footer.php'; ?>
                <script src="js/slider.js"></script>
	</body>
</html>
