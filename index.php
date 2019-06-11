<?php
$XmlSecurite = "https://www.01net.com/rss/actualites/securite/";
$XmlApplisLogiciels = "https://www.01net.com/rss/actualites/applis-logiciels/";
$XmlTechnos = "https://www.01net.com/rss/actualites/technos/";
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" />
</head>

<body>
    <?php
        $RssSecurite = simplexml_load_file($XmlSecurite);
        $RssApplisLogiciels = simplexml_load_file($XmlApplisLogiciels);
        $RssTechnos = simplexml_load_file($XmlTechnos);

        foreach($xml as $)
        ?>

    <nav>
        <div class="nav-wrapper">
            <a href="#!" class="brand-logo">Logo</a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                <li><a href="sass.html">Sécurité</a></li>
                <li><a href="badges.html">Applis/logiciels</a></li>
                <li><a href="collapsible.html">Technos</a></li>
            </ul>
        </div>
    </nav>
    <ul class="sidenav" id="mobile-demo">
        <li><a href="sass.html">Sécurité</a></li>
        <li><a href="badges.html">Applis/logiciels</a></li>
        <li><a href="collapsible.html">Techno</a></li>
    </ul>
    <form method="get" action="user.php">
        <p><label>Votre nom : </label><input type="text" name="lastName" /></p>
        <p><label>Votre prénom : </label><input type="text" name="firstName" /></p>
        <p>
            <label> Quelle est votre couleur préféré ?</label>
        </p>
        <p>
            <input class="with-gap" name="group1" type="radio" checked />
            <span>Noir</span>
        </p>
        <p>
            <label>
                <input class="with-gap" name="group1" type="radio" />
                <span>Bleu</span>
            </label>
        </p>
        <p>
            <label>
                <input class="with-gap" name="group1" type="radio" />
                <span>Rouge</span>
            </label>
        </p>
        <p>
            <label> Nombre d'articles affiché par sujet sur la page d'accueil: </label>
        </p>
        <p>
            <input class="with-gap" name="group1" type="radio" checked />
            <span>3</span>

        </p>
        <p>
            <label>
                <input class="with-gap" name="group1" type="radio" />
                <span>5</span>
            </label>
        </p>
        <p>
            <label>
                <input class="with-gap" name="group1" type="radio" />
                <span>8</span>
            </label>
        </p>
        <input type="submit" value="Valider" />
    </form>
    <div class="row">
        <div class="col m4">
            <div class="collection">
                <a href="#!" class="collection-item"><?= title; ?></a>
            </div>
        </div>
        <div class="col m4">
            <div class="collection">
                <a href="#!" class="collection-item">Alvin</a>
                <a href="#!" class="collection-item active">Alvin</a>
                <a href="#!" class="collection-item">Alvin</a>
                <a href="#!" class="collection-item">Alvin</a>
            </div>
        </div>
        <div class="col m4">
            <div class="collection">
                <a href="#!" class="collection-item">Alvin</a>
                <a href="#!" class="collection-item active">Alvin</a>
                <a href="#!" class="collection-item">Alvin</a>
                <a href="#!" class="collection-item">Alvin</a>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="script.js"></script>
</body>

</html>