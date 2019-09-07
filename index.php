<?php

use App\Config;

require 'init.php';

/*if ( get_registrations_count() >= Config::REGISTRATION_LIMIT)  {
    header('Location: index.php');
} else {
    if ( date('Y-m-d H:i') < '2019-09-04 19:00' && !is_admin_logged_in() ) {
        header('Location: index.php');
    }
}*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        
        <?php include("html/meta.html"); ?>

        <title>Inscription aux ateliers du Pôle Simon Le Franc</title>
    </head>

    <body>

         <?php include("html/header.php"); ?>

        <div id="container">

            <div id="corps">

                <table style="width: 100%;">
                    <tr>
                        <td style="width: 50%;"><img style="width: 200px; margin-top: 10px; margin-left: -3px; margin-bottom: 10px;" src="assets/img/PARIS_LOGO-small.png" alt="Mairie de Paris" /></td>
                        <td style="width: 50%;"></td>
                    </tr>
                </table>
                <h1>Inscription en ligne fermée</h1>
                <p>Bonjour &agrave; tous,<br /><br />Le site de gestion de file d'attente virtuelle pour les inscriptions de la saison 2019-2020 est d&eacute;sormais ferm&eacute;.</p>
                <p>Pour les personnes qui ont pu b&eacute;n&eacute;ficier d'un ordre de passage, rendez-vous le samedi 7 septembre au P&ocirc;le Simon Le Franc &agrave; l'heure qui vous a &eacute;t&eacute; communiqu&eacute;e. Merci de venir muni de votre r&eacute;c&eacute;piss&eacute; ainsi que de votre dossier au complet.</p>
                <p>Pour les personnes qui n'ont pas d'ordre de passage nous vous invitons &agrave; venir &agrave; l'accueil sur nos horaires d'ouverture habituels &agrave; partir du lundi 9 septembre (du lundi au jeudi de 9h30 &agrave; 20h30 (fermeture le mardi matin), le vendredi de 9h30 &agrave; 19h30 et le samedi de 10h &agrave; 17h).</p>
                <p><span style="font-family: verdana, sans-serif;">A tr&egrave;s bient&ocirc;t,<br />L'&eacute;quipe du P&ocirc;le Simon Le Franc</span></p>
                <p><span style="font-family: verdana, sans-serif;"><em>Nb : Le standard t&eacute;l&eacute;phonique ne sera pas assur&eacute; le samedi 7 septembre"</em></span></p>
            </div>

            <?php include("html/footer.html"); ?>

        </div>

    </body>

</html>