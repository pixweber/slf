<?php
require 'init.php';

if ( get_registrations_count() >= 180) {
    header('Location: index.php');
}

$isSubscribing = TRUE; // Affiche les étapes dans l'en-tête

if ( isset($_POST['next_step']) ) {
    $period = $_POST['period'];
    $person = $_POST['person'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $sex = $_POST['sex'];
    $birthday = $_POST['birthday'];
    $address = $_POST['address'];
    $address_plus = $_POST['address_plus'];
    $zip = $_POST['zip'];
    $city = $_POST['city'];
    $phone = $_POST['phone'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $confirm_email = $_POST['confirm_email'];

    $registration_options = $_POST['registration_options'];

    $registration_options_dict = array(
         'for_me' => 'Je m\'inscris',
         'for_my_family_members' => 'J\'inscris les membres de ma famille',
         'for_other_family_members' => 'J\'inscris les membres d’une autre famille',
    );

    $registration_options_html = '<ul id="registration-options-readonly" class="margin-top-10 padding-top-10 padding-bottom-10">';

    foreach ($registration_options as $registration_option) {
        $registration_options_html .= "<li>$registration_options_dict[$registration_option]</li>";
    }

    $registration_options_html .= '</ul>';

    $nb_inscrit = $_POST['nb_inscrit'];
} else {
    header("Location: inscription_2.php");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        
        <?php include("html/meta.html"); ?>

        <title>Inscription aux ateliers du Pôle Simon Le Franc</title>
    </head>

    <body>

        <script lang="Javascript">
            function ResetDroitImage() {
                document.getElementById("droit_image").value = "";
                return false;
            }
            function ResetAutorParent() {
                document.getElementById("autorisation_parent").value = "";
                return false;
            }
        </script>

        <?php include("html/header.php"); ?>

        <div id="container">

            <div id="corps">

                <table style="width: 100%;">
                    <tr>
                        <td style="width: 50%;"><img style="width: 200px; margin-top: 10px; margin-left: -3px; margin-bottom: 10px;" src="resources/mairiedeparis.jpg" alt="Mairie de Paris" /></td>
                        <td style="width: 50%; margin-top: 15px;"><p style="padding: 0;float: right;margin-right: 10px;">Étape 3/4</p></td>
                    </tr>
                </table>
                <h1>Valider vos coordonnées</h1>

                <!--<p>
                        <?php 
                        if (isset($_POST['next_step']))
                        {
                            echo 'Vous souhaitez inscrire un ';

                            if ($person == 'child')
                                echo '<b>enfant</b>';
                            else
                                echo '<b>adulte</b>';

                            echo ' pour ';

                            if ($period == 'year')
                                echo '<b>des activités annuelles.</b>';
                            else
                                echo '<b>un stage.</b>';
                            echo ' Pour modifier les informations, vous pouvez retourner sur la page précédente en cliquant sur le bouton <i>Précédent</i>.';
                        }
                        ?>
                        
                    </p>-->

                <form name="form" method="post" action="inscription_4.php" enctype="multipart/form-data">
                    <fieldset>
                        <legend>Identité</legend>
                        <table class="form" style="width: 100%">
                            <tr>
                                <td style="width: 10%;">
                                    <label for="last_name">Nom :</label>
                                </td>
                                <td style="width: 40%;">
                                    <input style="float: right; width: 100%;margin-right: 10px;" type="text" name="last_name" class="input_readonly" value="<?php echo $last_name; ?>" readonly>
                                </td>
                                <td style="width: 13%;">
                                    <label for="first_name">Prénom :</label>
                                </td>
                                <td style="width: 37%;">
                                    <input style="float: right; width: 100%;" type="text" name="first_name" class="input_readonly" value="<?php echo $first_name; ?>" readonly>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2" style="width: 50%;">
                                    <?php echo 'Sexe : ' . $sex; ?>  
                                </td>
                                <td colspan="2" style="width: 50%;">
                                    <label for="fname">Date de naissance :</label>
                                    <input type="text" name="birthday" class="input_readonly" value="<?php echo $birthday; ?>" readonly>
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
                                    <input style="width: 100%;" type="text" name="address" class="input_readonly" value="<?php echo $address; ?>" readonly>
                                </td>
                            </tr>

                            <?php
                                if ( $address_plus != "" ) {
                                    echo '<tr>
                                        <td style="width: 200px;">
                                            <label for="address_plus">Complément d\'adresse :</label>
                                        </td>
                                        <td>
                                            <input style="width: 100%;" type="text" name="address_plus" class="input_readonly" value="' . $address_plus . '" readonly>
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
                                    <input style="width: 90%;" type="text" name="zip" class="input_readonly" value="<?php echo $zip; ?>" readonly>
                                </td>
                                <td style="width: 90px;">
                                    <label for="city">Ville :</label>
                                </td>
                                <td >
                                    <input style="width: 100%;" type="text" name="city" class="input_readonly" value="<?php echo $city; ?>" readonly>
                                </td>
                            </tr>
                            
                            <tr>
                                <td style="width: 110px;">
                                    <label for="phone">Téléphone (fixe) :</label>
                                </td>
                                <td>
                                    <input style="width: 90%;" type="text" name="phone" class="input_readonly" value="<?php echo $phone; ?>" readonly> 
                                </td>
                                <td style="width: 90px;">
                                    <label for="mobile">Portable :</label>
                                </td>
                                <td>
                                    <input style="width: 100%;" type="text" name="mobile" class="input_readonly" value="<?php echo $mobile; ?>" readonly>
                                </td>
                            </tr>
                            
                            <tr>
                                <td style="width: 110px;">
                                    <label for="email">Adresse mail :</label>
                                </td>
                                <td colspan="3">
                                    <input style="width: 100%;" type="text" name="email" class="input_readonly" value="<?php echo $email; ?>" readonly>
                                </td>
                            </tr>
                            
                            <tr>
                                <td style="width: 110px;">
                                    <label for="confirm_email">Confirmation :</label>
                                </td>
                                <td colspan="3">
                                    <input style="width: 100%;" type="text" name="confirm_email" class="input_readonly" value="<?php echo $confirm_email; ?>" readonly>
                                </td>
                            </tr>
                            
                        </table>
                    </fieldset>
                    <fieldset>
                        <legend>Personnes à inscrire</legend>
                        <label for="activities">Vous avez choisi :</label>
                            <div>
                                <?php echo $registration_options_html; ?>
                            </div>
                            <input type="hidden" name="registration_options" value="<?php echo convert_array_to_json_input_value($registration_options); ?>" />
                        <table class="form" style="width: 100%">
                            <tr>
                                <td style="width: 190px;">
                                    <label for="nb_inscrit">Nombre d'inscriptions :</label>
                                </td>
                                <td>
                                    <input style="width: 20%;" type="text" name="nb_inscrit" id="nb_inscrit" class="input_readonly" value="<?php echo $nb_inscrit; ?>" readonly> 
                                </td>
                            <tr/>
                        </table>
                    </fieldset>
                        <br/> <br/>
                    <?php
                    function IsOver18($date) {
                        $date = str_replace('-', '/', $date);
                        $date = str_replace('.', '/', $date);
                        $tabDate = explode('/' , $date);
                        $dateBirth = mktime(0, 0, 0, $tabDate[1], $tabDate[0], $tabDate[2]);
                        $dateToday = mktime(0, 0, 0, date('m'), date('d'), date('Y') - 18);

                        if ($dateBirth <= $dateToday)
                            return TRUE;
                        else
                            return FALSE;
                    }

                    if (!IsOver18($birthday)) {
                        echo '
                        <fieldset>
                            <legend>Autorisation parentale</legend>
                            <p style="text-align: center;"><a href="files/autor_parent.pdf"><img src="resources/pdf_download.png" style="width: 30px; margin: 0px 8px -7px 0;" />Télécharger la fiche d\'autorisation parentale</a></p>
                            <table style="width: 100%">
                                <tr>
                                    <td style="width: 50%;">
                                        <label for="autorisation_parent">Fiche d\'autorisation parentale signée : </label>
                                    </td>
                                    <td style="width: 50%;">
                                        <input type="file" name="autorisation_parent" id="autorisation_parent">
                                        <input type="button" name="autorisation_parent_reset" id="autorisation_parent_reset" value="Effacer" onclick="return ResetAutorParent();" />
                                    </td>
                                </tr>
                            </table>
                            <span style="font-size: 0.8em;">Vous pourrez également restituer cette fiche signée le jour de l\'inscription au secrétariat.</span>
                        </fieldset>';
                    }
                    ?>
                        
                    <?php
                        echo '<input type="hidden" name="period" value="'.htmlentities($period).'">';
                        echo '<input type="hidden" name="person" value="'.htmlentities($person).'">';
                        echo '<input type="hidden" name="sex" value="'.htmlentities($sex).'">';
                    ?>
                    <center><input type="submit" name="next_step" value="Valider" /></center>
                </form>
                <form method="post" action="inscription_2.php">
                    <?php
                        if ( $_POST['next_step'] ) {
                            echo '<input type="hidden" name="period" value="'.htmlentities($period).'">';
                            echo '<input type="hidden" name="person" value="'.htmlentities($person).'">';
                            echo '<input type="hidden" name="first_name" value="'.htmlentities($first_name).'">';
                            echo '<input type="hidden" name="last_name" value="'.htmlentities($last_name).'">';
                            echo '<input type="hidden" name="sex" value="'.htmlentities($sex).'">';
                            echo '<input type="hidden" name="birthday" value="'.htmlentities($birthday).'">';
                            echo '<input type="hidden" name="address" value="'.htmlentities($address).'">';
                            echo '<input type="hidden" name="address_plus" value="'.htmlentities($address_plus).'">';
                            echo '<input type="hidden" name="zip" value="'.htmlentities($zip).'">';
                            echo '<input type="hidden" name="city" value="'.htmlentities($city).'">';
                            echo '<input type="hidden" name="phone" value="'.htmlentities($phone).'">';
                            echo '<input type="hidden" name="mobile" value="'.htmlentities($mobile).'">';
                            echo '<input type="hidden" name="registration_options" value="'.convert_array_to_json_input_value($registration_options).'">';
                            echo '<input type="hidden" name="nb_inscrit" value="'.htmlentities($nb_inscrit).'">';
                            echo '<input type="hidden" name="email" value="'.htmlentities($email).'">';
                            echo '<input type="hidden" name="confirm_email" value="'.htmlentities($confirm_email).'">';
                        }
                    ?>
                    <center><input style="margin-top: 5px;" type="submit" name="previous_step" value="Précédent" /></center>
                </form>

            </div>

            <?php include("html/footer.html"); ?>

        </div>

    </body>

</html>