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

    <title>Melun - Hôpitaux</title>

    <?php require 'partials/head_assets.php'; ?>

</head>
<body>
<div>


    <div>

<main>
    <article>
        <h2>Nouvel hôpital de Melun - Santépôle</h2>
        <ul><li>270 Rue Marc Jacquet</li>
            <li>77000 MELUN</li>
            <li>01 81 74 17 17</li>
        </ul>

        <h2>Clinique Saint Jean-L'Ermitage</h2>
        <ul><li>272 Avenue Marc Jaquet</li>
            <li>77000 MELUN</li>
            <li>0 826 30 77 77</li>
            <br>
            <li>Horaires :</li>
            <li>lundi à samedi : 8h-20h<br/>
            <li>dimanche : 11h-20h</li>
        </ul>

        <h2>Clinique des Fontaines</h2>
        <ul><li>54 Boulevard Aristide Briand</li>
            <li>77000 MELUN</li>
            <li>01 60 56 40 00</li>
            <br>
            <li>Horaires :</li>
            <li>tous les jours : 6h45-19h</li>
        </ul>
    </article>
</main>

<?php
require ('partials/footer.php');
?>
<script>
    let open = document.querySelector('#openNav')
    let nav = document.querySelector('#nav')
    let close = document.querySelector('#close')

    open.addEventListener('click', function () {
        nav.style.display = 'block'
    })

    close.addEventListener('click', function () {
        nav.style.display = 'none'
    })



    /* let modalOpenBtn = document.querySelectorAll('.modalOpenBtn')
    let modalCloseBtn = document.querySelectorAll('.modalCloseBtn')

    item.addEventListener('click', function () {
        openModal(modal, this)
    }) */



</script>
</body>
</html>