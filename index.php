<?php
require 'init.php';

if (get_registrations_count() < 200) {
    header('Location: inscription_1.php');
}
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
                        <td style="width: 50%;"><img style="width: 200px; margin-top: 10px; margin-left: -3px; margin-bottom: 10px;" src="resources/mairiedeparis.jpg" alt="Mairie de Paris" /></td>
                        <td style="width: 50%;"></td>
                    </tr>
                </table>
                <h1>Inscription en ligne fermée</h1>
                <p>Les inscriptions en ligne aux activités du pôle Simon Le Franc sont désormais fermées. Veuillez vous adresser directement 
                au secrétariat pour plus d'informations.</p>
                <br/>
            </div>

            <?php include("html/footer.html"); ?>

        </div>

    </body>

</html>