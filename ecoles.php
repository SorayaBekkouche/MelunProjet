<?php
require_once 'tools/common.php';
header("Access-Control-Allow-Origin: *");

if(isset($_GET['logout']) && isset($_SESSION['user'])){
    unset($_SESSION["user"]);
}

?>
<!DOCTYPE html>
<html>
<head>

    <title>Melun - Ecoles</title>

    <?php require 'partials/head_assets.php'; ?>

</head>
<body>
<?php require ('partials/nav.php'); ?>

<main>
    <article>
        <h2>Groupe scolaire Jean Bonis</h2>
        <ul><li>4 Rue Robert Schuman</li>
            <li>77000 MELUN</li>
            <li>01 60 68 55 16</li>
        </ul>

        <h2>Ecole d'application Pasteur</h2>
        <ul><li>64 Rue du Général de Gaulle</li>
            <li>77000 MELUN</li>
            <li>01 69 68 53 71</li>
        </ul>

        <h2>Ecole Montessori Melun</h2>
        <ul><li>16 rue Saint-Louis</li>
            <li>77000 MELUN</li>
            <li>07 81 41 01 30</li>
        </ul>

        <h2>Ecole maternelle Jules Ferry</h2>
        <ul><li>1 Rue Jules Ferry</li>
            <li>77000 MELUN</li>
            <li>01 64 09 17 85</li>
        </ul>

        <h2>Ecole maternelle les Capucins</h2>
        <ul><li>Rue Edouard Branly</li>
            <li>77000 MELUN</li>
            <li>01 64 09 17 77</li>
        </ul>

        <h2>Ecole maternelle Gabriel Leroy</h2>
        <ul><li>Place Chapu</li>
            <li>77000 MELUN</li>
            <li>01 64 37 97 66</li>
        </ul>

        <h2>Ecole maternelle Henri Dunant</h2>
        <ul><li>Rue Jean Moulin</li>
            <li>77000 MELUN</li>
            <li>01 64 09 22 28</li>
        </ul>

        <h2>Collège Pierre Brossolette</h2>
        <ul><li>Boulevard de l'Almont</li>
            <li>77000 MELUN</li>
            <li>01 60 68 06 68</li>
        </ul>

        <h2>Groupe scolaire Les Capucins</h2>
        <ul><li>21 route de Voisenon</li>
            <li>77000 MELUN</li>
            <li>01 64 09 10 75</li>
        </ul>

        <h2>Institution Sainte Marie</h2>
        <ul><li>10 Boulevard Gambetta</li>
            <li>77000 MELUN</li>
            <li>01 64 52 39 77</li>
        </ul>

        <h2>Ecole primaire Jules Ferry</h2>
        <ul><li>Rue Jules Ferry</li>
            <li>77000 Melun</li>
            <li>01 64 38 99 78</li>
        </ul>

        <h2>Collège Pierre Brossolette</h2>
        <ul><li>Boulevard de l'Almont</li>
            <li>77000 MELUN</li>
            <li>01 60 68 06 68</li>
        </ul>

        <h2>Collège Pierre Brossolette</h2>
        <ul><li>Boulevard de l'Almont</li>
            <li>77000 MELUN</li>
            <li>01 60 68 06 68</li>
        </ul>

        <h2>Collège Pierre Brossolette</h2>
        <ul><li>Boulevard de l'Almont</li>
            <li>77000 MELUN</li>
            <li>01 60 68 06 68</li>
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