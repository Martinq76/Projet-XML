<?php
session_start();
$_SESSION['lastName'];
$_SESSION['firstName'];
$_SESSION['articleNumber'];
$_SESSION['choiceColor'];

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
}

$XmlSecurite = "https://www.01net.com/rss/actualites/securite/";
$XmlApplisLogiciels = "https://www.01net.com/rss/actualites/applis-logiciels/";
$XmlTechnos = "https://www.01net.com/rss/actualites/technos/";
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
                        echo 'blue';
                    elseif ($_COOKIE['choiceColor'] == 'red'):
                        echo 'red';
                    elseif (count($_COOKIE) == 0):
                        echo 'red';
                    endif; ?>">
        <div class="nav-wrapper">
            <a href="#" class="brand-logo toto">Logoo</a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                <li><a href="securite">Sécurité</a></li>
                <li><a href="applis">Application</a></li>
                <li><a href="technos">Technos</a></li>
                <li><?= $_COOKIE['firstName'] ?></li>
                <li>  <a class="waves-effect waves-light btn modal-trigger" href="#inscription">Inscription</a></li>
                <li><a href="parametres"><i class="material-icons"> settings</i></a></li>
            </ul>
        </div>
    </nav>
    <ul class="sidenav" id="mobile-demo">
        <li><a href="securite">Sécurité</a></li>
        <li><a href="applis">Application</a></li>
        <li><a href="technos">Technos</a></li>
        <li><?= $_GET['firstName'] ?></li>
        <li><a href="deconnexion">Déconnexion</a></li>
        <li><a href="parametres"><i class="material-icons"> settings</i></a></li>
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

    <?php
    if (isset($_GET['page']) && $_GET['page'] == 'securite'):
        echo $RssSecurite->channel->item[1]->title;
    elseif (isset($_GET['page']) && $_GET['page'] == 'applis'):
        echo $RssApplisLogiciels->channel->item[0]->title;
    elseif (isset($_GET['page']) && $_GET['page'] == 'technos'):
        echo $RssTechnos->channel->item[0]->title;
    endif;

    if (!empty($loginUtili) && !empty($mdpUtili) && !empty($choiceColor) && !empty($articleNumber)): ?>
        <div class="row">
            <div class="col m4">
                <h1 class="titleHome" style="color: <?= $choiceColor ?>"><b><u>Sécurité</u></b></h1>
            </div>
            <div class="col m4">
                <h1 class="titleHome" style="color: <?= $choiceColor ?>"><b><u>Applis/Logiciels</u></b></h1>
            </div>
            <div class="col m4">
                <h1 class="titleHome" style="color: <?= $choiceColor ?>"><b><u>Technos</u></b></h1>
            </div>
        </div>
    <?php
    for ($i = 0; $i < $_GET['articleNumber']; $i++): 
    setlocale (LC_TIME, 'fr_FR.utf8','fra'); ?>
    <div class="row">
        <div class="col m4">

            <img src="<?= $RssSecurite->channel->item[$i]->enclosure{'url'} ?>" alt="" class="circle" width="100"
                height="50">
            <span class="title"><?= $RssSecurite->channel->item[$i]->title ?></span>
            <p>Sécurité<br>
                <?= $RssSecurite->channel->item[$i]->pubDate ?> <br>
                <a class="waves-effect waves-light btn modal-trigger"
                    href="<?= $RssSecurite->channel->item[$i]->link ?>">Lien</a>

                <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Description</a>
                <div id="modal1" class="modal">
                    <div class="modal-content">
                        <h4>Description</h4>
                        <p><?= $RssSecurite->channel->item[$i]->description ?></p>
                    </div>
                    <div class="modal-footer">
                        <a href="<?= $RssSecurite->channel->item[$i]->link ?>"
                            class="waves-effect waves-green btn-flat">Lien</a>
                        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fermer</a>
                    </div>
                </div>
            </p>


            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
        </div>
        <div class="col m4">
            <img src="<?= $RssApplisLogiciels->channel->item[$i]->enclosure{'url'} ?>" alt="" class="circle" width="100"
                height="50">
            <span class="title"><?= $RssApplisLogiciels->channel->item[$i]->title ?></span>
            <p>Applis/Logiciels <br>
                <?= $RssApplisLogiciels->channel->item[$i]->pubDate ?> <br>
                <a class="waves-effect waves-light btn modal-trigger"
                    href="<?= $RssApplisLogiciels->channel->item[$i]->link ?>">Lien</a>
                <a class="waves-effect waves-light btn modal-trigger" href="#modal2">Description</a>
                <div id="modal2" class="modal">
                    <div class="modal-content">
                        <h4>Description</h4>
                        <p><?= $RssApplisLogiciels->channel->item[$i]->description ?></p>
                    </div>
                    <div class="modal-footer">
                        <a href="<?= $RssApplisLogiciels->channel->item[$i]->link ?>"
                            class="waves-effect waves-green btn-flat">Lien</a>
                        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fermer</a>
                    </div>
                </div>
            </p>
            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
        </div>
        <div class="col m4">
            <img src="<?= $RssTechnos->channel->item[$i]->enclosure{'url'} ?>" alt="" class="circle" width="100"
                height="50">
            <span class="title"><?= $RssTechnos->channel->item[$i]->title ?></span>
            <p>Technos <br>
                <?= $RssTechnos->channel->item[$i]->pubDate ?> <br>
                <a class="waves-effect waves-light btn modal-trigger"
                    href="<?= $RssTechnos->channel->item[$i]->link ?>">Lien</a>
                <a class="waves-effect waves-light btn modal-trigger" href="#modal3">Description</a>
                <div id="modal3" class="modal">
                    <div class="modal-content">
                        <h4>Description</h4>
                        <p><?= $RssTechnos->channel->item[$i]->description ?></p>
                    </div>
                    <div class="modal-footer">
                        <a href="<?= $RssTechnos->channel->item[$i]->link ?>"
                            class="waves-effect waves-green btn-flat">Lien</a>
                        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fermer</a>
                    </div>
                </div>
            </p>
            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
        </div>
    </div>
    <?php
endfor;
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