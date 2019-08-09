<?php
    
session_start();

if (!isset($_SESSION['password']))
    header('location: admin.php');

if (isset($_GET['file']))
{
    $file = $_GET['file'];
    $id = $_GET['id'];
    if (file_exists('subs/' . $file))
        unlink('subs/' . $_GET['file']);
    if ($_GET['doc1'] != '')
        unlink('subs/' . $_GET['doc1']);
    if ($_GET['doc2'] != '')
        unlink('subs/' . $_GET['doc2']);
    if (file_exists('subs/pile.txt'))
    {
        file_put_contents('subs/pile.txt', str_replace($file, "", file_get_contents('subs/pile.txt')));
        file_put_contents('subs/pile.txt', str_replace($file . "\r\n", "", file_get_contents('subs/pile.txt')));
    }
    if (file_exists('subs/noms.txt'))
    {
        file_put_contents('subs/noms.txt', str_replace($id, "", file_get_contents('subs/noms.txt')));
        file_put_contents('subs/noms.txt', str_replace($id . "\r\n", "", file_get_contents('subs/noms.txt')));
    }
}

header('location : admin_main_subscribers.php');

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
                <p>L'utilisateur a été correctement supprimé.</p>
                <p style="text-align: center;"><a href="admin_main_subscribers.php">Retourner à la liste</a></p>
            </div>

            <?php include("html/footer.html"); ?>

        </div>

    </body>

</html>