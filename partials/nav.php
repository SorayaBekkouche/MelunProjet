
<header>
    <nav id="navigation" role="navigation" class="sticky" style="background-color: white;">
        <ul style="display: flex; justify-content: space-evenly; align-items: center; list-style: none">
            <li><a href="index.php"><img src="img/services/Melun-logo-ble.png" style="width: 130px;"></a></li>
            <li><a href="index.php" id="index">Accueil</a></li>
            <li><a href="event-list.php" id="evenements">Evenements</a></li>
            <li><a href="signalement.php" id="signalement">Signalement</a></li>
            <li><span style="font-size:25px;">|</span></li>
            <?php if(isset($_SESSION['user'])): ?>
                    <li>
                        <a href="index.php?logout">Déconnexion</a>
                        <?php if($_SESSION['user']['is_admin'] == 1): ?>
                        <a href="admin/index.php">Administration</a>
                        <?php else: ?>
                        <a href="user-profile.php">Profil</a>
                        <?php endif; ?>

            <?php else: ?>
            <a href="login-register.php" id="espaceperso">Espace personnel</a>
                <?php endif; ?></li>

        </ul>
    </nav>

    <a href="index.php"><img src="img/services/Melun-logo.png" id="logoBlc"></a>
    <div id="openNav">
        <div class="burger"></div>
        <div class="burger"></div>
        <div class="burger"></div>
    </div>

    <ul class="menu-sidebar" id="nav">
        <li id="close" class="burgerLi" >X</li>
        <li><a href="index.php" class="burgerLi">Accueil</a></li>
        <li><a href="event-list.php" class="burgerLi">Evenements</a></li>
        <li><a href="signalement.php" class="burgerLi">Signalement </a></li>
        <li><?php if(isset($_SESSION['user'])): ?>
                    <a href="index.php?logout" class="burgerLi">Déconnexion</a>
                    <?php if($_SESSION['user']['is_admin'] == 1): ?>
                        <a class="burgerLi" href="admin/index.php">Administration</a>
                    <?php else: ?>
                        <a class="burgerLi" href="user-profile.php">Profil</a>
                    <?php endif; ?>

            <?php else: ?>
                <a class="burgerLi" href="login-register.php">Espace personnel</a>
            <?php endif; ?></li>
    </ul>
</header>






