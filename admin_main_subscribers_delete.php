<?php
session_start();

if (!isset($_SESSION['password'])) {
    header('location: admin.php');
}

require 'init.php';
use App\Utils;

if (!isset($_GET['appointment_id'])) {
    header("Location: " . \App\Config::SITE_URL . "/admin_main_subscribers.php");
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
                        <td style="width: 50%; margin-top: 15px;"><a href="admin_main.php" style="float: right;margin-right: 10px;">Retour au menu</a></td>
                    </tr>
                </table>
                <h1>Espace administrateur - Suppression</h1>

                <?php
                // Get person fullname
                $person_id = Utils::get_person_id_by_appointment_id($_GET['appointment_id']);
                $person = new \App\Models\Person($person_id);
                $person_fullname = strtoupper($person->getFirstName()) . ' ' . $person->getLastName();

                // Delete an appointment and the associated person
                Utils::delete_appointment($_GET['appointment_id']);
                ?>

                <p class="text-center" style="color: red;">L'utilisateur <strong><?php echo $person_fullname; ?></strong> a été correctement supprimé.</p>
                <p style="text-align: center;"><a href="admin_main_subscribers.php">Retourner à la liste</a></p>
            </div>

            <?php include("html/footer.html"); ?>

        </div>

    </body>

</html>