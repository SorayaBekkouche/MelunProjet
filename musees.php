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

    <title>Melun - Musées</title>

    <?php require 'partials/head_assets.php'; ?>

</head>
<body>
<div>


    <div>
<main>
    <article>
        <h2>Musée d'Art et d'Histoire de Melun</h2>
        <ul><li>5 Rue du Franc Mûrier</li>
            <li>77000 MELUN</li>
            <li>01 64 79 77 70</li>
            <br>
            <li>Horaires :</li>
            <li>lundi-mardi : fermé</li>
            <li>mercredi à dimanche : 14h-18h</li>
        </ul>

        <h2>Musée de la Gendarmerie Nationale</h2>

        <ul><li>1-3 Rue Emile Leclerc</li>
            <li>77000 MELUN</li>
            <li>01 64 14 54 64</li>
            <br>
            <li>Horaires :</li>
            <li>mardi: fermé</li>
            <li>mercredi à lundi : 10h-17h30</li>
        </ul>
    </article>
</main>

<?php
require ('partials/footer.php');
?>
</body>
</html>