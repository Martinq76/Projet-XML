<?php
if (!empty($_GET['lastName']) && !empty($_GET['firstName']) && !empty($_GET['choiceColor']) && !empty($_GET['articleNumber'])) {
    $_GET = array_map('strip_tags',$_GET);
    $loginUtili = $_GET['lastName'];
    $mdpUtili = $_GET['firstName'];
    $choiceColor = $_GET['choiceColor'];
    $articleNumber = $_GET['articleNumber'];
    setcookie('lastName', $loginUtili, time() + 360, '/', 'rssfeed.info', false, true);
    setcookie('firstName', $mdpUtili, time() + 360, '/', 'rssfeed.info', false, true);
    setcookie('articleNumber', $articleNumber, time() + 360, '/', 'rssfeed.info', false, true);
    setcookie('choiceColor', $choiceColor, time() + 360, '/', 'rssfeed.info', false, true);
    header('location: /accueil');
}
if (isset($_GET) && $_GET['page'] == 'deconnexion'):
    foreach($_COOKIE as $cookie_nom=>$cookie_valeur){

        // Suppression du cookie en fixant une date d'expiration dans le passé
        setcookie($cookie_nom, '', time() - 3600, '/', 'rssfeed.info', false, true);
     
        // Suppression de la valeur du cookie dans la variable $_COOKIE
        unset($_COOKIE[$cookie_nom]);
     }
     header('location: /accueil');
endif;

if (isset($_GET['colorChoice']) && isset($_GET['numberArticle'])):
    setcookie('choiceColor', '', time() - 3600, '/', 'rssfeed.info', false, true);
    setcookie('articleNumber', '', time() - 3600, '/', 'rssfeed.info', false, true);
    setcookie('choiceColor', $_GET['colorChoice'], time() + 360, '/', 'rssfeed.info', false, true);
    setcookie('articleNumber', $_GET['numberArticle'], time() + 360, '/', 'rssfeed.info', false, true);
    header('location: /accueil');
endif;

$XmlSecurite = "https://www.01net.com/rss/actualites/securite/";
$XmlApplisLogiciels = "https://www.01net.com/rss/actualites/applis-logiciels/";
$XmlTechnos = "https://www.01net.com/rss/actualites/technos/";
setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
function dateFr($date) {
    return ucfirst(strftime("%A %d %B %Y %H:%M:%S", strtotime($date)));
}
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" />
</head>

<body>
    <?php
        $RssSecurite = simplexml_load_file($XmlSecurite);
        $RssApplisLogiciels = simplexml_load_file($XmlApplisLogiciels);
        $RssTechnos = simplexml_load_file($XmlTechnos);
?>
    <nav class="<?php
                    if ($_COOKIE['choiceColor'] == 'black'):
                        echo 'black';
                    elseif ($_COOKIE['choiceColor'] == 'blue'):
                        echo 'cyan darken-3';
                    elseif ($_COOKIE['choiceColor'] == 'red'):
                        echo 'red darken-2';
                    elseif (count($_COOKIE) == 0):
                        echo 'red';
                    endif; ?>">
        <div class="nav-wrapper">
            <a href="accueil" class="brand-logo toto">RssFeed</a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                <li><a href="securite">Sécurité</a></li>
                <li><a href="applis">Application</a></li>
                <li><a href="technos">Technos</a></li>
                <li style="font-weight:bold; font-size:1.5rem; color:#616161"> <?php
                if (!empty($_COOKIE['firstName'])):?>
                    Bonjour <?= $_COOKIE['firstName'] ?></li> <?php
                endif; ?>
                <li><a class="waves-effect grey lighten-5 btn modal-trigger" style="color:black"
                        href="#inscription">Inscription</a></li>
                <li><a href="deconnexion">Déconnexion</a></li>
                <li><a href="#parametres" class="modal-trigger"><i class="material-icons"> settings</i></a></li>
            </ul>
        </div>
    </nav>
    <ul class="sidenav" id="mobile-demo">
        <li><a href="securite">Sécurité</a></li>
        <li><a href="applis">Application</a></li>
        <li><a href="technos">Technos</a></li>
        <li><b><?= $_GET['firstName'] ?></b></li>
        <li><a class="waves-effect waves-light btn modal-trigger" href="#inscription">Inscription</a></li>
        <li><a href="deconnexion">Déconnexion</a></li>
        <li><a href="#parametres" class="modal-trigger"><i class="material-icons"> settings</i></a></li>
    </ul>

    <div id="inscription" class="modal">
        <div class="modal-content">
            <h4>Inscription</h4>
            <form method="get" action="index.php">
                <p><label>Votre nom : </label><input type="text" name="lastName" required /></p>
                <p><label>Votre prénom : </label><input type="text" name="firstName" required /></p>
                <p>
                    <label> Quelle est votre couleur préféré ?</label>
                </p>
                <p>
                    <input class="with-gap" name="choiceColor" value="black" type="radio" checked />
                    <span class="">Noir</span>
                </p>
                <p>
                    <label>
                        <input class="with-gap" name="choiceColor" value="blue" type="radio" />
                        <span class="cyan-text darken-2">Bleu</span>
                    </label>
                </p>
                <p>
                    <label>
                        <input class="with-gap" name="choiceColor" value="red" type="radio" />
                        <span class="red-text darken-4">Rouge</span>
                    </label>
                </p>
                <p>
                    <label> Nombre d'articles affiché par sujet sur la page d'accueil: </label>
                </p>
                <p>
                    <input class="with-gap" name="articleNumber" value="3" type="radio" checked />
                    <span>3</span>

                </p>
                <p>
                    <label>
                        <input class="with-gap" name="articleNumber" value="5" type="radio" />
                        <span>5</span>
                    </label>
                </p>
                <p>
                    <label>
                        <input class="with-gap" name="articleNumber" value="8" type="radio" />
                        <span>8</span>
                    </label>
                </p>
                <input type="submit" value="Valider" />
            </form>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fermer</a>
        </div>
    </div>

    <div id="parametres" class="modal">
        <div class="modal-content">
            <h4>Préférences utilisateur</h4>
            <form method="get" action="index.php">
                <label> Quelle est votre couleur préféré ?</label>
                </p>
                <p>
                    <input class="with-gap" name="colorChoice" value="black" type="radio" checked />
                    <span class="">Noir</span>
                </p>
                <p>
                    <label>
                        <input class="with-gap" name="colorChoice" value="blue" type="radio" />
                        <span class="cyan-text darken-2">Bleu</span>
                    </label>
                </p>
                <p>
                    <label>
                        <input class="with-gap" name="colorChoice" value="red" type="radio" />
                        <span class="red-text darken-4">Rouge</span>
                    </label>
                </p>
                <p>
                    <label> Nombre d'articles affiché par sujet sur la page d'accueil: </label>
                </p>
                <p>
                    <input class="with-gap" name="numberArticle" value="3" type="radio" checked />
                    <span>3</span>

                </p>
                <p>
                    <label>
                        <input class="with-gap" name="numberArticle" value="5" type="radio" />
                        <span>5</span>
                    </label>
                </p>
                <p>
                    <label>
                        <input class="with-gap" name="numberArticle" value="8" type="radio" />
                        <span>8</span>
                    </label>
                </p>
                <input type="submit" value="Valider" />
            </form>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fermer</a>
        </div>
    </div>

    <?php
if (!empty($_COOKIE['firstName']) && !empty($_COOKIE['lastName']) && !empty($_COOKIE['choiceColor']) && !empty($_COOKIE['articleNumber'])): 
    if (isset($_GET['page']) && $_GET['page'] == 'securite'): ?>
    <div class="row">
        <?php
        for ($i = 0; $i <= 29; $i++):
        ?>
        <div class="col s12 m4">
            <div class="card">
                <div class="card-image">
                    <img src="<?= $RssSecurite->channel->item[$i]->enclosure{'url'} ?>" alt="" width="50" height="250">
                    <span class="card-title" style="font-weight: bold; color: <?= $_COOKIE['choiceColor']; ?> ;text-shadow: -1px 0 white, 0 1px white,
                    1px 0 white, 0 -1px white"><?= $RssSecurite->channel->item[$i]->title ?></span>
                </div>
                <div class="card-content">
                    <p> <?= dateFr($RssSecurite->channel->item[$i]->pubDate); ?> </p>
                </div>
                <div class="card-action">
                    <a class="waves-effect waves-light btn modal-trigger"
                        style="background-color: <?= $_COOKIE['choiceColor']; ?>"
                        href="<?= $RssSecurite->channel->item[$i]->link ?>">Lien vers l'article</a>
                    <a class="waves-effect waves-light btn modal-trigger"
                        style="background-color: <?= $_COOKIE['choiceColor']; ?>"
                        href="#descriptionCategorie1<?= $i ?>">Description</a>
                    <div id="descriptionCategorie1<?= $i ?>" class="modal">
                        <div class="modal-content">
                            <h4>Description</h4>
                            <p><?= $RssSecurite->channel->item[$i]->description ?></p>
                        </div>
                        <div class="modal-footer">
                            <a href="<?= $RssSecurite->channel->item[$i]->link ?>"
                                class="modal-close waves-effect waves-green btn-flat">Lien vers l'article</a>
                            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fermer</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endfor; ?>
    </div>
    <?php 
    elseif (isset($_GET['page']) && $_GET['page'] == 'applis'): ?>
    <div class="row">
        <?php
        for ($i = 0; $i <= 30; $i++): ?>

        <div class="col s12 m4">
            <div class="card">
                <div class="card-image">
                    <img src="<?= $RssApplisLogiciels->channel->item[$i]->enclosure{'url'} ?>" alt="" width="50"
                        height="250">
                    <span class="card-title" style="font-weight: bold; color: <?= $_COOKIE['choiceColor']; ?> ;text-shadow: -1px 0 white, 0 1px white,
                        1px 0 white, 0 -1px white"><?= $RssApplisLogiciels->channel->item[$i]->title ?></span>
                </div>
                <div class="card-content">
                    <p> <?= dateFr($RssApplisLogiciels->channel->item[$i]->pubDate); ?> </p>
                </div>
                <div class="card-action">
                    <a class="waves-effect waves-light btn modal-trigger"
                        style="background-color: <?= $_COOKIE['choiceColor']; ?>"
                        href="<?= $RssApplisLogiciels->channel->item[$i]->link ?>">Lien vers l'article</a>
                    <a class="waves-effect waves-light btn modal-trigger"
                        style="background-color: <?= $_COOKIE['choiceColor']; ?>"
                        href="#descriptionCategorie2<?= $i ?>">Description</a>
                    <div id="descriptionCategorie2<?= $i ?>" class="modal">
                        <div class="modal-content">
                            <h4>Description</h4>
                            <p><?= $RssApplisLogiciels->channel->item[$i]->description ?></p>
                        </div>
                        <div class="modal-footer">
                            <a href="<?= $RssApplisLogiciels->channel->item[$i]->link ?>"
                                class="modal-close waves-effect waves-green btn-flat">Lien vers l'article</a>
                            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fermer</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        endfor; ?>
    </div>
    <?php
    elseif (isset($_GET['page']) && $_GET['page'] == 'technos'): ?>
    <div class="row">
        <?php
        for ($i = 0; $i <= 29; $i++):
        ?>
        <div class="col s12 m4">
            <div class="card">
                <div class="card-image">
                    <img src="<?= $RssTechnos->channel->item[$i]->enclosure{'url'} ?>" alt="" width="50" height="250">
                    <span class="card-title" style="font-weight: bold; color: <?= $_COOKIE['choiceColor']; ?> ;text-shadow: -1px 0 white, 0 1px white,
                    1px 0 white, 0 -1px white"><?= $RssTechnos->channel->item[$i]->title ?></span>
                </div>
                <div class="card-content">
                    <p> <?= dateFr($RssTechnos->channel->item[$i]->pubDate); ?> </p>
                </div>
                <div class="card-action">
                    <a class="waves-effect waves-light btn modal-trigger"
                        style="background-color: <?= $_COOKIE['choiceColor']; ?>"
                        href="<?= $RssTechnos->channel->item[$i]->link ?>">Lien vers l'article</a>
                    <a class="waves-effect waves-light btn modal-trigger"
                        style="background-color: <?= $_COOKIE['choiceColor']; ?>"
                        href="#descriptionCategorie3<?= $i ?>">Description</a>
                    <div id="descriptionCategorie3<?= $i ?>" class="modal">
                        <div class="modal-content">
                            <h4>Description</h4>
                            <p><?= $RssTechnos->channel->item[$i]->description ?></p>
                        </div>
                        <div class="modal-footer">
                            <a href="<?= $RssTechnos->channel->item[$i]->link ?>"
                                class="modal-close waves-effect waves-green btn-flat">Lien vers l'article</a>
                            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fermer</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endfor; ?>
    </div>
    <?php
    elseif (count($_GET) == 0 || isset($_GET['page']) && $_GET['page'] == 'accueil'): ?>
    <div class="row">
        <div class="col m4">
            <h1 class="titleHome" style="color: <?= $_COOKIE['choiceColor'] ?>"><b><u>Sécurité</u></b></h1>
        </div>
        <div class="col m4">
            <h1 class="titleHome" style="color: <?= $_COOKIE['choiceColor'] ?>"><b><u>Applis/Logiciels</u></b></h1>
        </div>
        <div class="col m4">
            <h1 class="titleHome" style="color: <?= $_COOKIE['choiceColor'] ?>"><b><u>Technos</u></b></h1>
        </div>
    </div>
    <?php
    for ($i = 0; $i < $_COOKIE['articleNumber']; $i++): 
    setlocale (LC_TIME, 'fr_FR.utf8','fra'); ?>
    <div class="row">
        <div class="col m4">
            <img src="<?= $RssSecurite->channel->item[$i]->enclosure{'url'} ?>" alt="" class="circle" width="100"
                height="50">
            <p class="title" style="font-weight: bold; color: <?= $_COOKIE['choiceColor']; ?> ;text-shadow: -1px 0 white, 0 1px white,
                1px 0 white, 0 -1px white"><?= $RssSecurite->channel->item[$i]->title ?></p>
            <p>Sécurité<br>
                <?= dateFr($RssSecurite->channel->item[$i]->pubDate); ?> <br>
                <a class="waves-effect waves-light btn modal-trigger"
                    style="background-color: <?= $_COOKIE['choiceColor']; ?>"
                    href="<?= $RssSecurite->channel->item[$i]->link ?>">Lien vers l'article</a>

                <a class="waves-effect waves-light btn modal-trigger"
                    style="background-color: <?= $_COOKIE['choiceColor']; ?>"
                    href="#modalHomeCol1<?= $i ?>">Description</a>
                <div id="modalHomeCol1<?= $i ?>" class="modal">
                    <div class="modal-content">
                        <h4>Description</h4>
                        <p><?= $RssSecurite->channel->item[$i]->description ?></p>
                    </div>
                    <div class="modal-footer">
                        <a href="<?= $RssSecurite->channel->item[$i]->link ?>" class="waves-effect btn-flat"
                            style="background-color: <?= $_COOKIE['choiceColor']; ?>">Lien vers l'article</a>
                        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fermer</a>
                    </div>
                </div>
            </p>
        </div>
        <div class="col m4">
            <img src="<?= $RssApplisLogiciels->channel->item[$i]->enclosure{'url'} ?>" alt="" class="circle" width="100"
                height="50">
            <p class="title" style="font-weight: bold; color: <?= $_COOKIE['choiceColor']; ?> ;text-shadow: -1px 0 white, 0 1px white,
                1px 0 white, 0 -1px white"><?= $RssApplisLogiciels->channel->item[$i]->title ?></p>
            <p>Applis/Logiciels <br>
                <?= dateFr($RssApplisLogiciels->channel->item[$i]->pubDate); ?> <br>
                <a class="waves-effect waves-light btn modal-trigger"
                    style="background-color: <?= $_COOKIE['choiceColor']; ?>"
                    href="<?= $RssApplisLogiciels->channel->item[$i]->link ?>">Lien vers l'article</a>
                <a class="waves-effect waves-light btn modal-trigger"
                    style="background-color: <?= $_COOKIE['choiceColor']; ?>"
                    href="#modalHomeCol2<?= $i ?>">Description</a>
                <div id="modalHomeCol2<?= $i ?>" class="modal">
                    <div class="modal-content">
                        <h4>Description</h4>
                        <p><?= $RssApplisLogiciels->channel->item[$i]->description ?></p>
                    </div>
                    <div class="modal-footer">
                        <a href="<?= $RssApplisLogiciels->channel->item[$i]->link ?>" class="waves-effect btn-flat"
                            style="background-color: <?= $_COOKIE['choiceColor']; ?>">Lien vers l'article</a>
                        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fermer</a>
                    </div>
                </div>
            </p>
        </div>
        <div class="col m4">
            <img src="<?= $RssTechnos->channel->item[$i]->enclosure{'url'} ?>" alt="" class="circle" width="100"
                height="50">
            <p class="title" style="font-weight: bold; color: <?= $_COOKIE['choiceColor']; ?> ;text-shadow: -1px 0 white, 0 1px white,
                1px 0 white, 0 -1px white"><?= $RssTechnos->channel->item[$i]->title ?></p>
            <p>Technos <br>
                <?= dateFr($RssTechnos->channel->item[$i]->pubDate); ?> <br>
                <a class="waves-effect waves-light btn modal-trigger"
                    style="background-color: <?= $_COOKIE['choiceColor']; ?>"
                    href="<?= $RssTechnos->channel->item[$i]->link ?>">Lien vers l'article</a>
                <a class="waves-effect waves-light btn modal-trigger"
                    style="background-color: <?= $_COOKIE['choiceColor']; ?>"
                    href="#modalHomeCol3<?= $i ?>">Description</a>
                <div id="modalHomeCol3<?= $i ?>" class="modal">
                    <div class="modal-content">
                        <h4>Description</h4>
                        <p><?= $RssTechnos->channel->item[$i]->description ?></p>
                    </div>
                    <div class="modal-footer">
                        <a href="<?= $RssTechnos->channel->item[$i]->link ?>" class="waves-effect btn-flat"
                            style="background-color: <?= $_COOKIE['choiceColor']; ?>">Lien vers l'article</a>
                        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fermer</a>
                    </div>
                </div>
            </p>
        </div>
    </div>
    <?php
endfor;
endif;
endif; ?>
    <style type="text/css">
        .color {
            color: <?=$choiceColor?>;
        }

        ;

        #color1 {
            background: <?=$choiceColor?>;
        }

        ;
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>