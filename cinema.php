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

    <title>Melun - Cinémas</title>

    <?php require 'partials/head_assets.php'; ?>

</head>
<body>
<div class=" ">


    <div class=" ">
<main>
    <article>
        <h2>Les Variétés</h2>
        <ul>
            <li>20 Boulevard Chamblain</li>
            <li>77000 MELUN</li>
            <li>01 60 63 69 74</li>
            <br>
            <li>Plus d'informations <a href="http://www.allocine.fr/seance/salle_gen_csalle=B0011.html">ici</a>.</li>
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