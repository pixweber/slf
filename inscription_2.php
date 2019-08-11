<?php
/*if (file_exists('subs/pile.txt') && count(file('subs/pile.txt')) >= 200) {
    header('Location: index.php');
}*/

echo '<pre>';
var_dump($_POST);
echo '</pre>';

$registration_options = null;
$registration_options_json = '';

if (isset($_POST['registration_options'])) {
    $registration_options_json = str_replace('\'', '"', $_POST['registration_options']);
    $registration_options = json_decode($registration_options_json, true);
}

$isSubscribing = TRUE; // Affiche les étapes dans l'en-tête

$period = '';
$person = '';

if ( isset($_POST['period']) ) {
    $period = $_POST['period'];
}

if ( isset($_POST['person']) ) {
    $person = $_POST['person'];
}
?>
<!DOCTYPE html>
<html>
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
                        <td style="width: 50%; margin-top: 15px;"><p style="padding: 0;float: right;margin-right: 10px;">Étape 2/4</p></td>
                    </tr>
                </table>
                <h1>Vos coordonnées</h1>
                    <?php
                    if (isset($_POST['next_step']) || isset($_POST['previous_step']))
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
                        echo " Pour modifier ce choix, vous pouvez retourner sur la page précédente en cliquant sur le bouton <i>Précédent</i>.";
                    }
                    ?>
                <p style="font-size: 0.8em;">Les champs marqués par une astérique rouge (<label style="color: red;">*</label>) sont nécessaires pour l'inscription.</p>
                <form id="registration-form-2" name="form" method="post" action="inscription_3.php">
                    <fieldset>
                        <legend>Identité</legend>
                        <table class="form" style="width: 100%">
                            <tr>
                                <td style="width: 10%;">
                                    <label class="star_field" for="lname">Nom :</label>
                                </td>
                                <td style="width: 40%;">
                                    <input style="float: right; width: 100%;margin-right: 10px;" type="text" name="last_name" id="last_name"
                                           required value="<?php echo isset($_POST['last_name']) ? $_POST['last_name'] : ''; ?>">
                                </td>
                                <td style="width: 13%;">
                                    <label class="star_field" for="fname">Prénom :</label>
                                </td>
                                <td style="width: 37%;">
                                    <input style="float: right; width: 100%;" type="text" name="first_name" id="first_name" required value="<?php echo isset($_POST['first_name']) ? $_POST['first_name'] : ''; ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="width: 50%;">
                                    <label class="star_field" for="sex">Sexe :</label>
                                    <input type="radio" name="sex" value="M" checked required>M
                                    <input type="radio" name="sex" value="F">F
                                </td>
                                <td colspan="2" style="width: 50%;">
                                    <label class="star_field" for="fname">Date de naissance :</label>
                                    <input type="text" name="birthday" id="birthday" required value="<?php echo isset($_POST['birthday']) ? $_POST['birthday'] : ''; ?>"/>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                    <fieldset>
                        <legend>Coordonnées</legend>
                        <table class="form" style="width: 100%">
                            

                            <tr>
                                
                                <td style="width: 200px;">
                                    <label class="star_field" for="address">Adresse :</label>
                                </td>
                                
                                <td>
                                    <input style="width: 100%;" type="text" name="address" id="address" required value="<?php echo isset($_POST['address']) ? $_POST['address'] : ''; ?>" />
                                </td>
                                
                            </tr>
                            <tr>
                                <td style="width: 200px;">
                                    <label for="address_plus">Complément d'adresse :</label>
                                </td>
                                
                                <td>
                                    <input style="width: 100%;" type="text" name="address_plus" id="address_plus" value="<?php echo isset($_POST['address_plus']) ? $_POST['address_plus'] : ''; ?>" />
                                </td>
                            </tr>
                        </table>
                        <table class="form" style="width: 100%">
                            
                            <tr>
                                <td style="width: 140px;">
                                    <label class="star_field" for="zip">Code Postal :</label>
                                </td>
                                <td>
                                    <input style="width: 90%;" type="text" name="zip" id="zip" required value="<?php echo isset($_POST['zip']) ? $_POST['zip'] : ''; ?>" minlength="5" maxlength="5">
                                </td>
                                <td style="width: 90px;">
                                    <label class="star_field" for="city">Ville :</label>
                                </td>
                                <td>
                                    <input style="width: 100%;" type="text" name="city" id="city" required value="<?php echo isset($_POST['city']) ? $_POST['city'] : ''; ?>">
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 140px;">
                                    <label for="phone">Téléphone (fixe) :</label>
                                </td>
                                <td>
                                    <input style="width: 90%;" type="text" name="phone" id="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>">
                                </td>
                                <td style="width: 90px;">
                                    <label class="star_field" for="mobile">Portable :</label>
                                </td>
                                <td>
                                    <input style="width: 100%;" type="text" name="mobile" id="mobile" required value="<?php echo isset($_POST['mobile']) ? $_POST['mobile'] : ''; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 140px;">
                                    <label class="star_field" for="email">Adresse mail :</label>
                                </td>
                                <td colspan="3">
                                    <input style="width: 100%;" type="email" name="email" id="email" required value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                                </td>
                            </tr>
                            
                            <tr>
                                <td style="width: 140px;">
                                    <label class="star_field" for="confirm_email">Confirmation :</label>
                                </td>
                                <td colspan="3">
                                    <input style="width: 100%;" type="email" name="confirm_email" id="confirm_email" required value="<?php echo isset($_POST['confirm_email']) ? $_POST['confirm_email'] : ''; ?>">
                                </td>
                            </tr>
                            
                        </table>
                    </fieldset>
                    <fieldset>
                        <legend>Personnes à inscrire</legend>
                        <div style="position: relative; margin-bottom: 10px;">
                            <input type="checkbox" id="for_me" name="registration_options[]" value="for_me">
                            <label for="for_me">Je m’inscris.</label><br />

                            <input type="checkbox" id="for_my_family_members" name="registration_options[]" value="for_my_family_members">
                            <label for="for_my_family_members">J’inscris les membres de ma famille.</label><br/>

                            <input type="checkbox" id="for_other_family_members" name="registration_options[]" value="for_other_family_members">
                            <label for="for_other_family_members">J’inscris les membres d’une autre famille.</label><br/><br/>
                            <script type="text/javascript">
                                var checked_values = <?php echo $registration_options_json; ?>;
                                checked_values.forEach(function(value, key){
                                    console.log(value);
                                    $('input:checkbox[value="'+ value +'"]').prop('checked', true);
                                });
                            </script>
                        </div>

                        <table class="form" style="width: 100%">
                            <tr>
                                <td style="width: 190px;">
                                    <label class="star_field" for="nb_inscrit">Nombre d'inscriptions :</label>
                                </td>
                                <td>
                                    <input style="width: 20%;" type="text" name="nb_inscrit" id="nb_inscrit"
                                           value="<?php echo isset($_POST['nb_inscrit']) ? $_POST['nb_inscrit'] : ''; ?>" required min="1" max="5">
                                </td>
                            <tr/>
                        </table>

                        <!-- CHECK FONCTION PHP POUR LIMITER LA SAISI A 5 PERSONNES  -->
                        <center><p style="text-decoration: underline;">Attention vous ne pouvez inscrire les membres que d’une seule autre famille et dans la limite de <strong>5 </strong> personnes maximum.</p></center>
                    </fieldset>
                    <br/> <br/>
                    
                    <?php
                        echo '<input type="hidden" name="period" value="'.htmlentities($period).'">';
                        echo '<input type="hidden" name="person" value="'.htmlentities($person).'">';
                    ?>
                    <center><input type="submit" name="next_step" value="Suivant" class="search" /></center>
                </form>
                
                <form method="post" action="inscription_1.php">
                    <center><input style="margin-top: 5px;" type="submit" name="previous_step" value="Précédent" /></center>
                    <?php
                        if (isset($_POST['next_step'])) {
                            echo '<input type="hidden" name="period" value="'.htmlentities($period).'">';
                            echo '<input type="hidden" name="person" value="'.htmlentities($person).'">';
                        }
                    ?>
                </form>

            </div>

            <?php include("html/footer.html"); ?>

        </div>

    </body>

</html>