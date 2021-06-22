<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Montserrat&display=swap" rel="stylesheet"> 
    <!-- pour ajouter logo sur onglet des pages avoir image de 16x16 ou 32x32
         si .ico image/x-icon; si .pgn image/pgn-->
    <link rel="icon" type="image/x-icon" href="<?=HOST. 'webroot/favicon.ico'?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="favicon.ico" /><![endif]-->
    <title><?=isset($title) ? htmlentities($title) : 'Colambe' ?></title>
    <link rel="stylesheet" href="<?=HOST. 'webroot/css/style.css'?>">
    <meta name="description" content="Texte décrivant mon activité"> <!--TODO remplacer description-->
</head>
<body>
    <header class="l-header"> 
        <div class="l-header__logo">
            <a href="/"><img src="<?=HOST. 'webroot/img/logo-complet-144-55.png'?>" alt="Logo et baseline Colambe massages bien être" height="55" width="144"></a>
        </div>
        <nav class="l-header__nav">
            <div class="l-nav-mobile"><span class=l-nav-mobile__icon-menu></span></div>
            <!-- <label for="menu-mobile" class="l-nav__menu-mobile"><span class=l-nav__icon-menu></span></label> -->
            <!-- <input type="checkbox" id="menu-mobile" role="button"> -->
            <ul class = "l-nav">
                <li class="l-nav__menu"><a href="/">Accueil</a></li>
                <li class="l-nav__menu"><a href="/qui-suis-je">Qui suis-je ?</a></li>
                <li class="l-nav__menu"><a href="#">Particuliers</a>
                    <ul class="l-nav__submenu">
                        <li><a href="/shiatsu-sur-chaise">Shiatsu sur chaise</a></li>
                        <li><a href="/californien">Massage californien</a></li>   
                        <!-- <li><a href="massage-5-continents.html">Massage des 5 continents</a></li>    -->
                    </ul>
                </li>
                <li class="l-nav__menu"><a href="#">Evênementiel</a>
                    <ul class="l-nav__submenu">
                        <li><a href="/entreprise">Massage en entreprise</a></li>   
                        <li><a href="/evenementiel">Autre évênementiel</a></li>
                    </ul>
                </li>
                <li class="l-nav__menu"><a href="/tarifs">Tarifs</a></li>
                <li class="l-nav__menu"><a href="/contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <div class="<?= isset($banner) ? 'l-banner' : 'l-banner-empty' ?>">
    </div>  
    
    <main class="l-main" >
    
        <?= $content ?>
    
    </main>
    <footer class="l-footer">
        <!--Informations 1ère colonne -->
        <div class="l-footer__legislation column">
            <p class= "l-footer__legal-txt">Les massages proposés sont non thérapeutiques et ne s'apparentent à aucune pratique médicale.</p>
            <p class= "l-footer__legal-copyright">Colambe © 2020</p>
            <a class= "l-footer__legal-CGV" href="#">Mentions légales</a>
        </div>
        <!--Informations 2ème colonne -->
        <div class="l-footer__adress column">
            <img src="<?=HOST. 'webroot/img/logo-complet-144-55.png'?>" alt="Logo et baseline Colambe Massages bien-être" height="55" width="144">
            <address>Anne LERAY <br>80 avenue Ravel <br>44850 LIGNE</address>
        </div>
        <!--Informations 3ème colonne -->
        <div class="l-footer__contact column">
            <h3 class="l-footer__contact-title">Contact</h3>
            <address class='l-footer__contact-information'>
                <span class="l-footer__icon"><i class="fas fa-mobile-alt"></i></span>06 52 70 86 37 <br>
                <a href="https://www.facebook.com/colambe" target="_blank"><span class="l-footer__icon"><i class="fab fa-facebook"></i></span>colambe</a><br>
                <span class="l-footer__icon"><i class="far fa-envelope"></i></span>anne.leray8@gmail.com
            </address>
    
        </div>
    </footer>
    
    <script src="<?=HOST. 'webroot/js/app.js'?>"></script>
</body>
</html>    