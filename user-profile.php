<?php

require_once 'tools/common.php';

if(!isset($_SESSION['user'])){
	header('location:../index.php');
	exit;
}


$query = $db->prepare('SELECT * FROM user WHERE id = ?');
$query->execute(array($_SESSION['user']['id']));
$user = $query->fetch();
?>

<!DOCTYPE html>
<html>
 <head>

	<title>Melun - Espace personnel</title>

   <?php require 'partials/head_assets.php'; ?>
     <style>

     </style>

 </head>
 <body>
	<div>
		<div>

			<?php require 'partials/nav.php'; ?>

            <main class="col-9">
                <article>
                    <div>
                        <p> <span style="text-transform: uppercase;">NOM</span></p>
                        <p>Identifiant</p>
                    </div>
                    <table class="billsTable" >
                        <tr style="font-weight: bold; text-transform: uppercase; font-size: 15px;"><td>Document</td><td>date</td><td>statut</td></tr>
                        <tr>
                            <td>Type de facture<br>
                                N°
                            </td>
                            <td>
                                05/06/19
                            </td>
                            <td class="status">
                                <div class="topay">
                                    <a href="">A payer</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Type de facture<br>
                                N°
                            </td>
                            <td>
                                05/06/19
                            </td>
                            <td class="status">
                                <div class="paid">
                                    <a href="img/bills/100-Jim-Halpert.png" download > Payé</a>
                                </div>

                            </td>
                        </tr>
                        <tr>
                            <td>Type de facture<br>
                                N°
                            </td>
                            <td>
                                05/06/19
                            </td>
                            <td class="status">
                                <div class="paid">
                                    <a href="img/bills/100-Jim-Halpert.png" download > Payé</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Type de facture<br>
                                N°
                            </td>
                            <td>
                                05/06/19
                            </td>
                            <td class="status">
                                <div class="paid">
                                    <a href="img/bills/100-Jim-Halpert.png" download > Payé</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Type de facture<br>
                                N°
                            </td>
                            <td>
                                05/06/19
                            </td>
                            <td class="status">
                                <div class="paid">
                                    <a href="img/bills/100-Jim-Halpert.png" download > Payé</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Type de facture<br>
                                N°
                            </td>
                            <td>
                                05/06/19
                            </td>
                            <td class="status">
                                <div class="paid">
                                    <a href="img/bills/100-Jim-Halpert.png" download > Payé</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Type de facture<br>
                                N°
                            </td>
                            <td>
                                05/06/19
                            </td>
                            <td class="status">
                                <div class="paid">
                                    <a href="img/bills/100-Jim-Halpert.png" download > Payé</a>
                                </div>
                            </td>
                        </tr>
                    </table>

                </article>

            </main>
		</div>

		<?php require 'partials/footer.php'; ?>

	</div>
 </body>

</html>

