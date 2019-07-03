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
<main>
    <article>

    </article>
</main>

<?php
require ('partials/footer.php');
?>
</body>
</html>