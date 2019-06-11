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
        if (file_exists($XmlSecurite) && file_exists($XmlApplisLogiciels) && file_exists($XmlTechnos)):
        $RssSecurite = simplexml_load_file($XmlSecurite);
        $RssApplisLogiciels = simplexml_load_file($XmlApplisLogiciels);
        $RssTechnos = simplexml_load_file($XmlTechnos);
        else:
            echo 'Erreur lors du chargement des fichiers XML';
        endif;
        ?>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script src="script.js"></script>
    </body>
</html>