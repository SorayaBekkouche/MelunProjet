<?php
    //nombre d'en        ements de la table category
    $nbUsers = $db->query("SELECT COUNT(*) FROM user")->fetchColumn();
	//nombre d'en        ements de la table category
	$nbCategories = $db->query("SELECT COUNT(*) FROM category")->fetchColumn();
	//nombre d'enregistrements de la table article
	$nbEvents = $db->query("SELECT COUNT(*) FROM event")->fetchColumn();
    //nombre d'enregistrements de la table faq
    $nbQst = $db->query("SELECT COUNT(*) FROM faq_question")->fetchColumn();
    //nombre d'enregistrements de la table bills
    $nbBills = $db->query("SELECT COUNT(*) FROM bills")->fetchColumn();
?>
<nav class="col-3 py-2 categories-nav">
	<a class="d-block btn btn-warning mb-4 mt-2" href="../index.php">Site</a>
	<ul>
		<li><a href="user-list.php">Gestion des utilisateurs (<?= $nbUsers; ?>)</a></li>
		<li><a href="category-list.php">Gestion des catégories (<?= $nbCategories; ?>)</a></li>
		<li><a href="event-list.php">Gestion des évenements (<?= $nbEvents; ?>)</a></li>
        <li><a href="question-list.php">Gestion de la FAQ (<?= $nbQst; ?>)</a></li>
        <li><a href="bills.php">Gestion des factures (<?= $nbBills; ?>)</a></li>
	</ul>
</nav>
