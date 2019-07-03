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

    <title>Melun - Piscines</title>

    <?php require 'partials/head_assets.php'; ?>

</head>
<body>
<div>


    <div>
<main>
    <article>
        <h2>Piscine municipale</h2>
        <ul><li>50 Quai Maréchal Joffre</li>
            <li>77000 MELUN</li>
            <li>01 64 37 33 05</li>
            <br>
            <li>Horaires :</li>
            <li>lundi : fermé</li>
            <li>mardi : 12h – 14h, 16h45 – 19h</li>
            <li>mercredi : 11:00 – 16:30</li>
            <li>jeudi : 12:00 – 14:00, 16:45 – 19:00</li>
            <li>vendredi : 12:00 – 14:00, 19:00 – 20:30</li>
            <li>samedi : 11:00 – 17:00</li>
            <li>dimanche : 08:30 – 13:00</li>
        </ul>

        <h2>Pacificlub</h2>

        <ul><li>64 Quai Maréchal Joffre</li>
            <li>77000 MELUN</li>
            <li>01 64 37 77 30</li>
            <br>
            <li>Horaires :</li>
            <li>lundi : 09h-21h</li>
            <li>mardi : 9h-21h</li>
            <li>mercredi : 12h-21h</li>
            <li>jeudi : 9h-21h</li>
            <li>vendredi : 9h-20h30</li>
            <li>samedi : 9h-13, 15h-18h</li>
            <li>dimanche : 10h-13h</li>
        </ul>

        <h2>Evolufit</h2>

        <ul><li>10 Rue Camille Flammarion</li>
            <li>77000 MELUN</li>
            <li>01 64 09 15 00</li>
            <br>
            <li>Horaires :</li>
            <li>lundi à vendredi : 8h-21h30</li>
            <li>samedi : 9h-16h</li>
            <li>dimanche : 10h-14h</li>
        </ul>
    </article>
</main>

<?php
require ('partials/footer.php');
?>
</body>
</html>