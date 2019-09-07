<?php
session_start();

if (!isset($_SESSION['password'])) {
    header('location: admin.php');
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        
        <?php include("html/meta.html"); ?>

        <title>Administration - Pôle Simon Le Franc</title>
    </head>

    <body>

         <?php include("html/header.php"); ?>

        <div id="container">

            <div id="corps">

                <table style="width: 100%;">
                    <tr>
                        <td style="width: 50%;"><img style="width: 200px; margin-top: 10px; margin-left: -3px; margin-bottom: 10px;" src="assets/img/PARIS_LOGO-small.png" alt="Mairie de Paris" /></td>
                        <td style="width: 50%; margin-top: 15px;"><a href="admin_deconnect.php" style="float: right;margin-right: 10px;">Se déconnecter</a></td>
                    </tr>
                </table>
                <h1>Espace administrateur</h1>
                <table style="width: 100%">
                    <tr>
                        <td style="text-align: center;width: 50%;"><a href="admin_main_subscribers.php"><img src="resources/db.png" style="width: 24px;margin: 0px 8px -7px 0;" />Liste des inscrits</a></td>
                        <td style="text-align: center;width: 50%;"><a href="admin_main_files.php"><img src="resources/pdf_download.png" style="width: 24px;margin: 0px 8px -7px 0;" />Paramètres des fiches</a></td>
                    </tr>
                </table>
                <br/>
            </div>

            <?php include("html/footer.html"); ?>

        </div>

    </body>

</html>