<?php

require_once 'tools/common.php';
header("Access-Control-Allow-Origin: *");
if(isset($_GET['logout']) && isset($_SESSION['user'])){
    unset($_SESSION["user"]);
}

/*envoyer mail via php

if(isset($_POST['mailForm'])) {
    if(!empty($_POST['email']) AND !empty($_POST['message'])) {
        $header="MIME-Version: 1.0\r\n";
        $header.='From:"nom_dexpediteur"<sorayabekkouche@live.fr>'."\n";
      $header.='Content-Type:text/html; charset="uft-8"'."\n";
      $header.='Content-Transfer-Encoding: 8bit';
      $message='
      <html>
         <body>
            <div align="center">
               <br />
               <u>Mail de l\'expéditeur :</u>'.$_POST['email'].'<br />
               <br />
               '.nl2br($_POST['message']).'
               <br />
               <img src="http://www.primfx.com/mailing/separation.png"/>
            </div>
         </body>
      </html>
      ';
      mail("sorayabekkouche@live.fr", $message, $header);
      $msg="Votre message a été envoyé avec succès.";
   } else {
        $msg="Votre mail n'a pu être envoyé. Veuillez réessayer.";
    }
} */

if(isset($_POST['formConfirm'])) {
$email = htmlspecialchars($_POST['email']);
$message = sha1($_POST['message']);
if(!empty($_POST['mail']) AND !empty($_POST['message'])) {

                $getMail = $db->prepare("SELECT * FROM message WHERE email = ?");
                $getMail->execute(array($email));
                $mailExist = $getMail->rowCount();
                if($mailExist == 0) {
                        $insertmbr = $db->prepare("INSERT INTO message(email, message) VALUES(?, ?)");

                        $insertmbr->execute(array($email, $message));

                        $header="MIME-Version: 1.0\r\n";
                        $header.='From:"PrimFX.com"<support@primfx.com>'."\n";
                        $header.='Content-Type:text/html; charset="uft-8"'."\n";
                        $header.='Content-Transfer-Encoding: 8bit';
                        $message='
                     <html>
                        <body>
                           <div align="center">
                              <p>Contact</p>
                              <p>Merci, votre message a bien été envoyé.</p>
                           </div>
                        </body>
                     </html>
                     ';
                        mail($email, $message, $header);
                        $erreur = "Votre message a été envoyé avec succès. <a href=\"login-register.php\">Me connecter</a>";
                    } else {
                        $erreur = "Les informations de sont pas correctes.";
                    }
                } else {
                    $erreur = "Les informations de sont pas correctes.";
                }
            }

?>

?>
<!DOCTYPE html>
<html>
<head>

    <title>Melun - Signalement</title>

    <?php require 'partials/head_assets.php'; ?>
    <style>
        .tab {
            overflow: hidden;
            border-bottom: 1px solid #ccc;
        }
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
        }
        .tab button:hover {
            background-color: #ddd;
        }
        .tab button.active {
            background-color: #ccc;
        }
        .tabcontent {
            display: none;
            padding: 6px 12px;
        }



        #alert {
            display: none;
            margin-top: 20px;
            font-weight: bold;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }


        * {
            box-sizing: border-box;
        }


        .openedModal {
            display: block;
        }
        .closedModal {
            display: none;
        }
        .modalOpening {
            animation: 400ms modalOpening ease;
        }
        .modalClosing {
            animation: 400ms modalClosing ease;
        }
        .fadeIn {
            animation: 400ms fadeIn ease;
        }
        .fadeOut {
            animation: 400ms fadeOut ease;
        }
        #modal {
            z-index: 1000;
            position: absolute;
            top: 0;
            left: 0;
        }
        #modal .shadow {
            display: flex;
            flex-flow: row wrap;
            align-items: center;
            justify-content: center;
            /* - */
            height: 100vh;
            width: 100vw;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1001;
        }
        #modal .content {
            padding: 20px;
            width: 500px;
            border-radius: 5px;
            background-color: #fff;
            z-index: 1002;
        }
        #modal h1, #modal h2, #modal h3, #modal h4, #modal h5, #modal h6 {
            margin: 0;
            padding: 0;
        }

        @keyframes modalOpening {
            from {
                opacity: 0;
                transform: translateY(-1000px);
            }
            to {
                opacity: 1;
            }
        }
        @keyframes modalClosing {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
                transform: translateY(-1000px);
            }
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        @keyframes fadeOut {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
        }



    </style>
</head>
<body>
<div>


    <div>
        <?php require 'partials/nav.php'; ?>
<main>

    <article>

        <?php if(isset($msg)) {
            echo $msg;//affiche message d'erreur si les champs (ou un champ) pas remplis
        }
        ?>

        <div class="tab">
            <button class="tablinks" onclick="openForm(event, 'contact')">Contact</button>
            <button class="tablinks" onclick="openForm(event, 'signal')">Signalement</button>
        </div>

        <div id="contact" class="tabcontent">

                <form id="sendForm" enctype="multipart/form-data">
                    <div>
                        <label for="email">Email</label><br>
                        <input type="email" id="email" name="mail" value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } ?>"/><br /><br />
                    </div>

                    <div>
                        <label for="message">Votre message</label><br>
                        <textarea name="message" id="message"><?php if(isset($_POST['message'])) { echo $_POST['message']; } ?></textarea><br /><br />
                    </div>

                <div class="text-right">
                    <a href="user-profile.php"><input class="sendBtn" type="submit" name="formConfirm" value="Valider"/></a>
                </div>
            </form>
        </div>

        <div id="signal" class="tabcontent">
            <form id="signal" enctype="multipart/form-data">
                <div>
                    <label for="first_name">Prénom</label><br>
                    <input id="first_name" name="first_name" type="text" /><br /><br />
                </div>

                <div>
                    <label for="last_name">Nom</label><br>
                    <input type="text" id="last_name" name="prenom"/><br /><br />
                </div>


                <div>
                    <label for="email">Email</label><br>
                    <input type="email" id="email" name="mail"/><br /><br />
                </div>

                <div>
                    <label for="address">Adresse</label><br>
                    <input type="text" id="address" name="address"/><br /><br />
                </div>

                <div class="form-group">
                    <label for="category_id"> Catégorie :</label><br>
                    <select class="form-control" name="category_id" <!-- id="Choice"  onChange='Cats(this.form)' -->>
                        <?php
                        $query = $db->query('SELECT * FROM faq_category');
                        $cats = $query->fetchAll();
                        ?>
                        <?php foreach ($cats as $cat): ?>
                            <option value="<?= $cat['id']; ?>" <?= isset($question) AND $question['category_id'] == $cat['id'] ? 'selected' : ''; ?>><?= $cat['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div><br><br>

                <div class="form-group">
                    <label for="id_category"> Sous catégorie :</label><br>
                    <select class="form-control" id="SubCat" name="id_category">
                        <?php
                        $query = $db->query('SELECT * FROM faq_sub_cat');
                        $sbc = $query->fetchAll();
                        ?>
                        <?php foreach ($sbc as $sc): ?>
                            <option value="<?= $sc['id']; ?>" <?= isset($question) AND $question['id_category'] == $sc['id'] ? 'selected' : ''; ?>><?= $sc['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div><br><br>

                <div>
                    <label for="message">Votre message</label><br>
                    <textarea name="message" id="message"></textarea><br /><br />
                </div>

                <div class="text-right">
                    <a href="user-profile.php"><input class="sendBtn" type="submit" name="formConfirm" value="Valider"/></a>
                </div>
            </form>
        </div>

    </article>


</main>
</body>
<script>

    openForm(event, 'contact')
    
    function openForm(evt, formType) {
        let i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(formType).style.display = "block";
        evt.currentTarget.className += " active";
    }


    /* function Cats(form){
        i = form.Choice.selectedIndex;
        if (i == 0){
            return;
        }
        switch (i) {
            case 1 let txt new Array ('Mobiliers', 'Revêtements', 'Signalisation au sol'),
            case 2 let txt new Array ('Feux tricolores', 'Panneaux directionnels', 'Panneaux sectorisation'),
            case 3 let txt new Array ('Parcs', 'Squares', 'Aires de jeu', 'Espaces ornementaux'),
            case 4 let txt new Array ('Poubelles', 'Ramassages', 'Dégradations', 'Propreté de la voirie'),
            case 5 let txt new Array ('Autre');
                break;
        }
        form.Choice.selectedIndex = 0;
        for (i=0;i<3;i++) {
            form.SubCat.options[i+1].text=txt[i];
        }
    }

*/
</script>

<?php
require ('partials/footer.php');
?>

</html>