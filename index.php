<?php
session_start();
$_SESSION['lastName'];
$_SESSION['firstName'];
$_SESSION['articleNumber'];
$_SESSION['choiceColor'];
?>
<?php
if (isset($_GET['lastName']) && isset($_GET['firstName']) && isset($_GET['choiceColor']) && isset($_GET['articleNumber'])) {
    $loginUtili = $_GET['lastName'];
    $mdpUtili = $_GET['firstName'];
    $choiceColor = $_GET['choiceColor'];
    $articleNumber = $_GET['articleNumber'];
    setcookie('lastName', $loginUtili, time() + 360, '/', 'Projet-XML', false, true);
    setcookie('firstName', $mdpUtili, time() + 360, '/', 'Projet-XML', false, true);
    setcookie('articleNumber', $articleNumber, time() + 360, '/', 'Projet-XML', false, true);
    setcookie('choiceColor', $choiceColor, time() + 360, '/', 'Projet-XML', false, true);
}
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="css/style.css" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" />
    </head>
    <body>
        <?php
        $XmlSecurite = 'https://www.01net.com/rss/actualites/securite/';
        $XmlApplisLogiciels = 'https://www.01net.com/rss/actualites/applis-logiciels/';
        $XmlTechnos = 'https://www.01net.com/rss/actualites/technos/';
        $RssSecurite = simplexml_load_file($XmlSecurite);
        $RssApplisLogiciels = simplexml_load_file($XmlApplisLogiciels);
        $RssTechnos = simplexml_load_file($XmlTechnos);
        ?>
        <nav>
            <div class="nav-wrapper" style="background-color:<?=$choiceColor?>">
                <a href="#!" class="brand-logo toto">Logoo</a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="sass.html">Sécurité</a></li>
                    <li><a href="badges.html">Application</a></li>
                    <li><a href="collapsible.html">Téchno</a></li>
                    <li><?= $_GET['firstName'] ?></li>
                    <li><a href="settings.html"><i class="material-icons"> settings</i></a></li>
                </ul>
            </div>
        </nav>
        <ul class="sidenav" id="mobile-demo">
            <li><a href="sass.html">Sécurité</a></li>
            <li><a href="badges.html">Application</a></li>
            <li><a href="collapsible.html">Téchno</a></li>
            <li><a href="collapsible.html">se connecter</a></li>
        </ul>
        <form method="get" action="index.php">
            <p><label>Votre nom : </label><input type="text" name="lastName"/></p>
            <p><label>Votre prénom : </label><input type="text" name="firstName"/></p>
            <p>
                <label> Quelle est votre couleur préféré ?</label>
            </p>
            <p>
                <input class="with-gap" name="choiceColor" value="#353535" type="radio" checked />
                <span class="">Noir</span>
            </p>
            <p>
                <label>
                    <input class="with-gap" name="choiceColor" value="#086788" type="radio" />
                    <span class="cyan-text darken-2">Bleu</span>
                </label>
            </p>
            <p>
                <label>
                    <input class="with-gap" name="choiceColor" value="#ba0000" type="radio"  />
                    <span class="red-text darken-4">Rouge</span>
                </label>
            </p>
            <p>
                <label>  Nombre d'articles affiché par sujet sur la page d'accueil: </label>
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
                    <input class="with-gap" name="articleNumber" value="8" type="radio"  />
                    <span>8</span>
                </label>
            </p>
            <input type="submit" value="Valider" />
        </form>
        <?php
        for ($i = 0; $i < $_GET['articleNumber']; $i++):
            setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
            ?>
            <div class="row">
                <div class="col m4 color " style="background-color:<?= $choiceColor ?>">
                        <img src="<?= $RssSecurite->channel->item[$i]->enclosure{'url'} ?>" alt="" class="circle" width="100" height="50">
                        <p class="title"><?= $RssSecurite->channel->item[$i]->title ?></p>
                        <p>appli <br>
                            <?= $RssSecurite->channel->item[$i]->pubDate ?>
                        </p>
                        <a class="waves-effect waves-light btn" href="<?= $RssSecurite->channel->item[$i]->link ?>">Lien</a>
                        <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Description</a>
                        <div id="modal1" class="modal">
                            <div class="modal-content">
                                <h4>Description</h4>
                                <p><?= $RssSecurite->channel->item[$i]->description ?></p>
                            </div>
                            <div class="modal-footer">
                                <a href="<?= $RssSecurite->channel->item[$i]->link ?>" class="waves-effect waves-green btn-flat">lien</a>
                                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fermer</a>
                            </div>
                        </div>
                        </p>
                        <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
                    </div>
                <div class="col m4 color " style="background-color:<?= $choiceColor ?>">
                    <img src="<?= $RssApplisLogiciels->channel->item[$i]->enclosure{'url'} ?>" alt="" class="circle" width="100" height="50">
                    <p class="title"><?= $RssApplisLogiciels->channel->item[$i]->title ?></p>
                    <p>appli <br>
    <?= $RssApplisLogiciels->channel->item[$i]->pubDate ?>
                    </p>
                    <a class="waves-effect waves-light btn" href="<?= $RssApplisLogiciels->channel->item[$i]->link ?>">Lien</a>
                    <a class="waves-effect waves-light btn modal-trigger" href="#modal2">Description</a>
                        <div id="modal2" class="modal">
                            <div class="modal-content">
                                <h4>Description</h4>
                                <p><?= $RssApplisLogiciels->channel->item[$i]->description ?></p>
                            </div>
                            <div class="modal-footer">
                                <a href="<?= $RssApplisLogiciels->channel->item[$i]->link ?>" class="waves-effect waves-green btn-flat">lien</a>
                                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fermer</a>
                            </div>
                        </div>
                </p>
                <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
                </div>
                <div class="col m4 color" style="background-color:<?= $choiceColor ?>">
                    <img src="<?= $RssTechnos->channel->item[$i]->enclosure{'url'} ?>" alt="" class="circle" width="100" height="50">
                    <p class="title"><?= $RssTechnos->channel->item[$i]->title ?></p>
                    <p>techno <br>
    <?= $RssTechnos->channel->item[$i]->pubDate ?>
                    </p>
                    <a class="waves-effect waves-light btn" href="<?= $RssTechnos->channel->item[$i]->link ?>">Lien</a>
                    <a class="waves-effect waves-light btn modal-trigger" href="#modal3">Description</a>
                        <div id="modal3" class="modal">
                            <div class="modal-content">
                                <h4>Description</h4>
                                <p><?= $RssTechnos->channel->item[$i]->description ?></p>
                            </div>
                            <div class="modal-footer">
                                <a href="<?= $RssTechnos->channel->item[$i]->link ?>" class="waves-effect waves-green btn-flat">lien</a>
                                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fermer</a>
                            </div>
                        </div>
                </p>
                <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
                </div>
            </div>
            <?php
        endfor;
        ?>
        <style type="text/css">
            .color{
                color: white;
                height : 20rem;
                width: 15rem;
            };
        </style> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script src="assets/js/script.js"></script>
    </body>
</html>