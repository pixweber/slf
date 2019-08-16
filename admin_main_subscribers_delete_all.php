<?php
session_start();

if (!isset($_SESSION['password'])) {
    header('location: admin.php');
}

require 'init.php';
use App\Utils;
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
        Utils::delete_appointments();
        ?>

        <p class="text-center" style="color: red;">Les rendez-vous ont été correctement supprimés.</p>
        <p style="text-align: center;"><a href="/admin_main.php">Retourner à l'espace administrateur</a></p>
    </div>

    <?php include("html/footer.html"); ?>

</div>

</body>

</html>