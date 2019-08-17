<?php
session_start();
require 'init.php';

use App\Models\Appointment;

$appointment_id = isset($_GET['appointment_id']) ? $_GET['appointment_id'] : '';

if ( !isset($_SESSION['password']) || !$appointment_id ) {
    header('location: admin.php');
}

$appointment = new Appointment($appointment_id);
$person = $appointment->get_person();
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
                <p style="text-align: center;font-size: 1.3em;">Heure de passage : <?php echo $appointment->getHour(); ?></p>
                <form name="form">
                    <fieldset>
                        <legend>Identité</legend>
                        <table class="form" style="width: 100%">
                            <tr>
                                <td style="width: 10%;">
                                    <label for="lname">Nom :</label>
                                </td>
                                <td style="width: 40%;">
                                    <input style="float: right; width: 100%;margin-right: 10px;" type="text" class="input_readonly" value="<?php echo $person->getLastName(); ?>" name="lname" readonly>
                                </td>
                                <td style="width: 13%;">
                                    <label for="fname">Prénom :</label>
                                </td>
                                <td style="width: 37%;">
                                    <input style="float: right; width: 100%;" type="text" name="fname" class="input_readonly" value="<?php echo $person->getFirstName(); ?>" name="fname" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="width: 50%;">
                                    Sexe : <?php echo $person->getSex() === 1 ? 'M' : 'F'; ?>
                                </td>
                                <td colspan="2" style="width: 50%;">
                                    <label for="fname">Date de naissance :</label>
                                    <input type="text" name="birthday" class="input_readonly" value="<?php echo $person->getBirthdateFr(); ?>" name="birthday" readonly>
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
                                    <input style="width: 100%;" type="text" name="address" class="input_readonly" value="<?php echo $person->getAddress(); ?>" readonly>
                                </td>
                            </tr>
                            <?php
                            if ($person->getAddressPlus() !== "") :
                            ?>
                                <tr>
                                <td style="width: 200px;">
                                    <label for="address_plus">Complément d'adresse :</label>
                                </td>
                                <td>
                                    <input style="width: 100%;" type="text" name="address_plus" class="input_readonly" value="<?php $person->getAddressPlus() ? $person->getAddressPlus() : ''; ?>" readonly>
                                </td>
                            </tr>
                            <?php
                            endif;
                            ?>
                            
                        </table>
                        <table class="form" style="width: 100%">
                            <tr>
                                <td style="width: 140px;">
                                    <label for="zip">Code Postal :</label>
                                </td>
                                <td >
                                    <input style="width: 90%;" type="text" name="zip" class="input_readonly" value="<?php echo $person->getPostcode(); ?>" readonly>
                                </td>
                                <td style="width: 90px;">
                                    <label for="city">Ville :</label>
                                </td>
                                <td >
                                    <input style="width: 100%;" type="text" name="city" class="input_readonly" value="<?php echo $person->getCity(); ?>" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 110px;">
                                    <label for="phone">Téléphone (fixe) :</label>
                                </td>
                                <td>
                                    <input style="width: 90%;" type="text" name="phone" class="input_readonly" value="<?php echo $person->getPhone() ? $person->getPhone() : ''; ?>" readonly>
                                </td>
                                <td style="width: 90px;">
                                    <label for="mobile">Portable :</label>
                                </td>
                                <td>
                                    <input style="width: 100%;" type="text" name="mobile" class="input_readonly" value="<?php echo $person->getMobile(); ?>" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 110px;">
                                    <label for="mail">Adresse mail :</label>
                                </td>
                                <td colspan="3">
                                    <input style="width: 100%;" type="text" name="mail" class="input_readonly" value="<?php echo $person->getEmail(); ?>" readonly>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                    <fieldset>
                        <legend>Personne inscrites</legend>
                        <label for="activities">Choix :</label>
                        <div>
                            <?php echo $appointment->get_registration_options_html(); ?>
                        </div>
                        <table class="form" style="width: 100%">
                            <tr>
                                <td style="width: 190px;">
                                    <label for="nb_inscrit">Nombre d'inscriptions :</label>
                                </td>
                                <td>
                                    <input style="width: 20%;" type="text" name="nb_inscrit" id="nb_inscrit" class="input_readonly" value="<?php echo $appointment->getParticipants(); ?>" readonly>
                                </td>
                            <tr/>
                        </table>
                    </fieldset>
                    <?php                   
                        if ( 1 !== 1 ) {
                            echo '
                            <fieldset>
                                <legend>Autorisation parentale</legend>
                                <p style="text-align: center;"><a href="' . $subscribers_data[17] . '"><img src="resources/pdf_download.png" style="width: 30px; margin: 0px 8px -7px 0;" />Télécharger la fiche d\'autorisation parentale signée</a></p>
                            </fieldset>';
                        }

                        if ( 1 !== 1) {
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