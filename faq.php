<?php
require_once 'tools/common.php';

$categories = $db->query('SELECT * FROM faq_category ORDER BY name DESC');
$question = $db->query('SELECT * FROM faq_question');

if(isset($_GET['logout']) && isset($_SESSION['user'])){
    unset($_SESSION["user"]);

}

/*
//si pas de questino trouvé dans la base de données, renvoyer l'utilisateur vers la page index
//if(!$question['id']){
    //echo "Aucune question trouvée...";
//} */

?>

<!DOCTYPE html>
<html>
<head>

    <title>Melun</title>

    <?php require 'partials/head_assets.php'; ?>


    <style>
        @media all and (max-width: 835px) {
            .burgerLi {
                display: block;
                color: white;
                padding: 6% 20%;
            }
        }


        *{
            margin: 0;
            padding: 0;
        }

        .content{
            justify-content: center;
            align-items: center;
        }
        .center{
            width: 50%;
            align-self: center;
            margin: auto;
        }

        details{
            font-family: 'Raleway', sans-serif;
        }

        summary {
            transition: background .75s ease;
            width: 100%;
            outline: 0;
            text-align: center;
            font-size: 85%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            border-bottom: 1px solid #D3D3D3;
        }

        h2 {
            color: #A1CCA5;
            text-align: left;
            margin-bottom: 0;
            padding: 15px;
            text-shadow: none;
        }

        details p {
            padding: 0 25px 15px 25px;
            margin: 0;
            text-shadow: none;
            text-align: justify;
            line-height: 1.3em;
        }

        summary::after {
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            content: "\f107";
            display: inline-block;
            padding-right: 15px;
            font-size: 180%;
            color: #034171;
        }
        summary:hover {
            background: #d3d3d3;
        }

        details summary::-webkit-details-marker {
            display:none;
        }



    </style>
</head>
<body>

<?php
require ('partials/nav.php');
?>
<main>
    <h1><span class="verticalLine">|</span>FAQ</h1>
    <article>
        <div class="content">
            <div class="center">

                <?php while($cat = $categories->fetch()) {
                    ?>
                    <details>
                    <summary>
                        <h2><?= $cat['name'] ?></h2>
                        </summary>
                        <?php while($qst = $question->fetch()) {
                        ?>
                            <br><br><h4><?= $qst['subject'] ?></h4><br><br>
                            <p style="width: 80%;">
                                <?= $qst['content'] ?>
                            </p>
                        <?php } ?>
                    </details>
                <?php } ?>
            </div>
        </div>


    </article>

</main>
<?php
require ('partials/footer.php');
?>

</body>
</html>