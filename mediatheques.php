<?php
require_once 'tools/common.php';

if(isset($_GET['logout']) && isset($_SESSION['user'])){
    unset($_SESSION["user"]);
}
require ('partials/nav.php');
?>
<!DOCTYPE html>
<html>
<head>

    <title>Melun - Médiathèques</title>

    <?php require 'partials/head_assets.php'; ?>

</head>
<body>
<div>


    <div>

<main>
    <article>
        <h2>Médiathèque Astrolabe</h2>
        <ul>
            <li>25 rue du Château</li>
            <li>BP 60749</li>
            <li>77017 MELUN Cedex</li>
            <li>01 60 56 04 70</li>
            <br>
            <li>Horaires :</li>
            <li>mardi : 12h-18h</li>
            <li>mercredi : 10h-18h</li>
            <li>jeudi : 12h-18h</li>
            <li>vendredi : 12h-18h</li>
            <li>samedi : 10h-19h</li>
            <li>dimanche : 14h-18h*</li>
            <li>(hors vacances scolaires et jours fériés)</li>
        </ul>

        <h2>Archives de Melun</h2>

        <ul>
            <li>25 rue du Château</li>
            <li>BP 60749</li>
            <li>77017 MELUN Cedex</li>
            <li>01 60 56 54 30</li>
            <br>
            <li>Horaires :</li>
            <li>Du mardi au vendredi 8h45-12h et 13h45-17h15</li>
        </ul>

        <h2>Médiathèque Almont</h2>

        <ul>
            <li>Nouvelle adresse :</li>
            <li>2 rue Claude Bernard</li>
            <li>77000 MELUN</li>
            <li>01 64 52 52 80 (durant les horaires d'ouvertures uniquement)</li>
            <li>01 60 56 04 81</li>
            <br>
            <li>Horaires :</li>
            <li>mercredi : 14h-18h</li>
            <li>samedi : 14h-18h</li>
        </ul>
    </article>
</main>

<?php
require ('partials/footer.php');
?>
</body>
</html>