<?php
require 'init.php';

session_start();

if (isset($_SESSION['password'])) {
    header('location: admin_main.php');
}

$incorrect_pwd = FALSE;

if (isset($_POST['login']) && isset($_POST['password'])) {

    if ( md5($_POST['password']) === get_admin_password_hash() ) {
        session_start();
        $_SESSION['password'] = get_admin_password_hash();
        header('location: admin_main.php');
    }
    else {
        $incorrect_pwd = TRUE;
    }
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
                        <td style="width: 50%;"><img style="width: 200px; margin-top: 10px; margin-left: -3px; margin-bottom: 10px;" src="resources/mairiedeparis.jpg" alt="Mairie de Paris" /></td>
                        <td style="width: 50%;"></td>
                    </tr>
                </table>
                <h1>Connexion à l'espace administrateur</h1>
                <p>Afin d'accéder à l'espace administrateur, veuillez vous identifier :</p>
                <form method="post" action="admin.php">
                    <center>
                        <label for="password">Mot de passe : </label>
                        <input type="password" name="password" style="width: 160px" />
                        <input type="submit" name="login" value="Valider" />
                    </center>
                </form>
                <?php
                    if ($incorrect_pwd == TRUE)
                    {
                        echo '<p>Le mot de passe renseigné est invalide. Contactez l\'administrateur en cas de perte de mot de passe.</p>';
                    }
                ?>
                <br/>
            </div>

            <?php include("html/footer.html"); ?>

        </div>

    </body>

</html>