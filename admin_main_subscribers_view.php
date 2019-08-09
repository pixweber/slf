<?php
session_start();

if (!isset($_SESSION['password']) || $_GET['file'] == '')
    header('location: admin.php');

$file = fopen('subs/' . $_GET['file'], 'r');
$content = fread($file, filesize('subs/' . $_GET['file']));
$subscribers_data = array();
$j = 0;
while (!(strpos($content, '<' . $j . '>') === FALSE))
{
    $start = strpos($content, '<' . $j . '>') + strlen('<' . $j . '>');
    $length = strpos($content, '</' . $j . '>') - $start;
    $line = substr($content, $start, $length);
    $subscribers_data[$j] = $line;
    $j++;
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
                        <td style="width: 50%; margin-top: 15px;"><a href="admin_main_subscribers.php" style="float: right;margin-right: 10px;">Retour à la liste des inscrits</a></td>
                    </tr>
                </table>
                <h1>Espace administrateur</h1>
                <p style="text-align: center;font-size: 1.3em;">Heure de passage : <?php echo $subscribers_data[19]; ?></p>
                <form name="form">
                    <fieldset>
                        <legend>Identité</legend>
                        <table class="form" style="width: 100%">
                            <tr>
                                <td style="width: 10%;">
                                    <label for="lname">Nom :</label>
                                </td>
                                <td style="width: 40%;">
                                    <input style="float: right; width: 100%;margin-right: 10px;" type="text" class="input_readonly" value="<?php echo $subscribers_data[3]; ?>" name="lname" readonly>
                                </td>
                                <td style="width: 13%;">
                                    <label for="fname">Prénom :</label>
                                </td>
                                <td style="width: 37%;">
                                    <input style="float: right; width: 100%;" type="text" name="fname" class="input_readonly" value="<?php echo $subscribers_data[2]; ?>" name="lname" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="width: 50%;">
                                    <?php echo 'Sexe : ' . $subscribers_data[4]; ?>  
                                </td>
                                <td colspan="2" style="width: 50%;">
                                    <label for="fname">Date de naissance :</label>
                                    <input type="date" name="birthday" class="input_readonly" value="<?php echo $subscribers_data[5]; ?>" name="birthday" readonly>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                    <fieldset>
                        <legend>Coordonnées</legend>
                        <table class="form" style="width: 100%;">
                            <tr>
                                <td style="width: 200px;">
                                    <label for="address">Adresse :</label>
                                </td>
                                <td>
                                    <input style="width: 100%;" type="text" name="address" class="input_readonly" value="<?php echo $subscribers_data[6]; ?>" readonly>
                                </td>
                            </tr>
                            <?php
                                if ($subscribers_data[7] != "")
                                {
                                    echo '<tr>
                                        <td style="width: 200px;">
                                            <label for="address_plus">Complément d\'adresse :</label>
                                        </td>
                                        <td>
                                            <input style="width: 100%;" type="text" name="address_plus" class="input_readonly" value="' . $subscribers_data[7] . '" readonly>
                                        </td>
                                    </tr>';
                                }
                            ?>
                            
                        </table>
                        <table class="form" style="width: 100%">
                            <tr>
                                <td style="width: 140px;">
                                    <label for="zip">Code Postal :</label>
                                </td>
                                <td >
                                    <input style="width: 90%;" type="text" name="zip" class="input_readonly" value="<?php echo $subscribers_data[8]; ?>" readonly>
                                </td>
                                <td style="width: 90px;">
                                    <label for="city">Ville :</label>
                                </td>
                                <td >
                                    <input style="width: 100%;" type="text" name="city" class="input_readonly" value="<?php echo $subscribers_data[9]; ?>" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 110px;">
                                    <label for="phone">Téléphone (fixe) :</label>
                                </td>
                                <td>
                                    <input style="width: 90%;" type="text" name="phone" class="input_readonly" value="<?php echo $subscribers_data[10]; ?>" readonly> 
                                </td>
                                <td style="width: 90px;">
                                    <label for="GSM">Portable :</label>
                                </td>
                                <td>
                                    <input style="width: 100%;" type="text" name="GSM" class="input_readonly" value="<?php echo $subscribers_data[11]; ?>" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 110px;">
                                    <label for="mail">Adresse mail :</label>
                                </td>
                                <td colspan="3">
                                    <input style="width: 100%;" type="text" name="mail" class="input_readonly" value="<?php echo $subscribers_data[12]; ?>" readonly> 
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                    <fieldset>
                        <legend>Personne inscrites</legend>
                        <label for="activities">Choix :</label>
                        <center><textarea style="width: 98%;" id="activities" rows="6" name="activities" class="input_readonly" readonly><?php echo $subscribers_data[13]; ?></textarea/></center>
                        <table class="form" style="width: 100%">
                            <tr>
                                <td style="width: 190px;">
                                    <label for="nb_inscrit">Nombre d'inscriptions :</label>
                                </td>
                                <td>
                                    <input style="width: 20%;" type="text" name="nb_inscrit" id="nb_inscrit" class="input_readonly" value="<?php echo $subscribers_data[20]; ?>" readonly> 
                                </td>
                            <tr/>
                        </table>
                    </fieldset>
                    <?php
                        if ($subscribers_data[14] != '')
                        {
                            echo '
                                <fieldset>
                                    <legend>Quotient Familial</legend>
                                        <table class="form" style="width: 100%">
                                            <tr>
                                                <td style="width: 30%">
                                                    <label for="revenu_fiscal">Revenu fiscal de référence :</label>
                                                </td>
                                                <td style="width: 20%">
                                                    <input style="width: 70%;" type="text" name="revenu_fiscal" class="input_readonly" value="' . $subscribers_data[14] . '" readonly> €
                                                </td>
                                                <td style="width: 30%">
                                                    <label for="part_fiscal">Parts fiscales :</label>
                                                </td>
                                                <td style="width: 20%">
                                                    ' . $subscribers_data[15] . '
                                                </td>
                                            </tr>
                                        </table>
                                    <span>Le quotient familial de cette personne est de <b>' . round(floatval($subscribers_data[14]) / (12 * $subscribers_data[15])) . ' €</b>.</span>
                                </fieldset>';
                        }
                        ?>
                    <?php                   

                        if ($subscribers_data[17] != '')
                        {
                            echo '
                            <fieldset>
                                <legend>Autorisation parentale</legend>
                                <p style="text-align: center;"><a href="' . $subscribers_data[17] . '"><img src="resources/pdf_download.png" style="width: 30px; margin: 0px 8px -7px 0;" />Télécharger la fiche d\'autorisation parentale signée</a></p>
                            </fieldset>';
                        }
                        if ($subscribers_data[16] != '')
                        {
                            echo '
                            <fieldset>
                                <legend>Droit à l\'image</legend>
                                <p style="text-align: center;"><a href="' . $subscribers_data[16] . '"><img src="resources/pdf_download.png" style="width: 30px; margin: 0px 8px -7px 0;" />Télécharger la fiche d\'autorisation d\'utilisation de l\'image signée</a></p>
                            </fieldset>';
                        }
                    ?>
                </form>

            </div>

            <?php include("html/footer.html"); ?>

        </div>

    </body>

</html>