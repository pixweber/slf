<?php

if (file_exists('subs/pile.txt') && count(file('subs/pile.txt')) >= 200)
    header('Location: index.php');  

$isSubscribing = TRUE; // Affiche les étapes dans l'en-tête

if ($_POST['next_step'])
{
    $period = $_POST['period'];
    $person = $_POST['person'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $sex = $_POST['sex'];
    $birthday = $_POST['birthday'];
    $address = $_POST['address'];
    $address_plus = $_POST['address_plus'];
    $zip = $_POST['zip'];
    $city = $_POST['city'];
    $phone = $_POST['phone'];
    $gsm = $_POST['GSM'];
    $mail = $_POST['mail'];
    $cb1 = $_POST['cb1'];
    $cb2 = $_POST['cb2'];
    $cb3 = $_POST['cb3'];
    $cb4 = $_POST['cb4'];
    $activities = '';
    if ($cb1)
        $activities = $activities . 'Je m’inscris' . PHP_EOL;
    if ($cb2)
        $activities = $activities . 'J’inscris les membres de ma famille' . PHP_EOL;
    if ($cb3)
        $activities = $activities . 'J’inscris une autre personne' . PHP_EOL;
    if ($cb4)
        $activities = $activities . 'J’inscris les membres d’une autre famille' . PHP_EOL;
    $nb_inscrit = $_POST['nb_inscrit'];
    $revenu_fiscal = $_POST['revenu_fiscal'];
    $part_fiscal = $_POST['part_fiscal'];
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
                                    <label for="lname">Nom :</label>
                                </td>
                                <td style="width: 40%;">
                                    <input style="float: right; width: 100%;margin-right: 10px;" type="text" class="input_readonly" value="<?php echo $lname; ?>" name="lname" readonly>
                                </td>
                                <td style="width: 13%;">
                                    <label for="fname">Prénom :</label>
                                </td>
                                <td style="width: 37%;">
                                    <input style="float: right; width: 100%;" type="text" name="fname" class="input_readonly" value="<?php echo $fname; ?>" name="lname" readonly>
                                </td>
                            </tr>
                            <!--
                            <tr>
                                <td colspan="2" style="width: 50%;">
                                    <?php echo 'Sexe : ' . $sex; ?>  
                                </td>
                                <td colspan="2" style="width: 50%;">
                                    <label for="fname">Date de naissance :</label>
                                    <input type="date" name="birthday" class="input_readonly" value="<?php echo $birthday; ?>" name="birthday" readonly>
                                </td>
                            </tr>
                            -->
                            
                        </table>
                    </fieldset>
                    <fieldset>
                        <legend>Coordonnées</legend>
                        <table class="form" style="width: 100%;">
                            <!--
                            <tr>
                                <td style="width: 200px;">
                                    <label for="address">Adresse :</label>
                                </td>
                                <td>
                                    <input style="width: 100%;" type="text" name="address" class="input_readonly" value="<?php echo $address; ?>" readonly>
                                </td>
                            </tr>
                            --> 
                            
                            <?php
                                if ($address_plus != "")
                                {
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
                            <!--
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
                            --> 
                            
                            <tr>
                                <td style="width: 110px;">
                                    <label for="phone">Téléphone (fixe) :</label>
                                </td>
                                <td>
                                    <input style="width: 90%;" type="text" name="phone" class="input_readonly" value="<?php echo $phone; ?>" readonly> 
                                </td>
                                <td style="width: 90px;">
                                    <label for="GSM">Portable :</label>
                                </td>
                                <td>
                                    <input style="width: 100%;" type="text" name="GSM" class="input_readonly" value="<?php echo $gsm; ?>" readonly>
                                </td>
                            </tr>
                            
                            <tr>
                                <td style="width: 110px;">
                                    <label for="mail">Adresse mail :</label>
                                </td>
                                <td colspan="3">
                                    <input style="width: 100%;" type="text" name="mail" class="input_readonly" value="<?php echo $mail; ?>" readonly> 
                                </td>
                            </tr>
                            
                            <tr>
                                <td style="width: 110px;">
                                    <label for="mail">Confirmation :</label>
                                </td>
                                <td colspan="3">
                                    <input style="width: 100%;" type="text" name="mail" class="input_readonly" value="<?php echo $mail; ?>" readonly> 
                                </td>
                            </tr>
                            
                        </table>
                    </fieldset>
                    <fieldset>
                        <legend>Personnes à inscrire</legend>
                        <label for="activities">Vous avez choisi :</label>
                        <center><textarea style="width: 98%;" id="activities" rows="6" name="activities" class="input_readonly" readonly><?php echo $activities; ?></textarea/></center>
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
                        if (isset($revenu_fiscal) && $revenu_fiscal != '')
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
                                                    <input style="width: 70%;" type="text" name="revenu_fiscal" class="input_readonly" value="' . $revenu_fiscal . '" readonly> €
                                                </td>
                                                <td style="width: 30%">
                                                    <label for="part_fiscal">Parts fiscales :</label>
                                                </td>
                                                <td style="width: 20%">
                                                    ' . ($part_fiscal + 1) / 2 . '
                                                </td>
                                            </tr>
                                        </table>
                                    <span>Votre quotient familial est de <b>' . round(floatval($revenu_fiscal) / (12 * ($part_fiscal + 1) / 2)) . ' €</b>.</span>
                                </fieldset>';
                        }
                        ?>
                    <?php
                        
                        function IsOver18($date)
                        {
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

                        if (!IsOver18($birthday))
                        {
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

                    <!--
                        <fieldset>
                        <legend>Droits à l'image</legend>
                        <p style="text-align: center;"><a href="files/autor_image.pdf" target="_blank"><img src="resources/pdf_download.png" style="width: 30px; margin: 0px 8px -7px 0;" />Télécharger la fiche d'autorisation d'utilisation de l'image</a></p>
                        <table style="width: 100%">
                            <tr>
                                <td style="width: 50%;">
                                    <label for="droit_image">Fiche d'autorisation signée : </label>
                                </td>
                                <td style="width: 50%;">
                                    <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                                    <input type="file" name="droit_image" id="droit_image">
                                    <input type="button" name="droit_image_reset" id="droit_image_reset" value="Effacer" onclick="return ResetDroitImage();" />
                                </td>
                            </tr>
                        </table>
                        <span style="font-size: 0.8em;">Vous pourrez également restituer cette fiche signée le jour de l'inscription au secrétariat.</span>
                    </fieldset>
                        
                    <p><i><b>ATTENTION : </b>Une fois le formulaire validé, il n'est plus possible de modifier les informations fournies ci-dessus. 
                    Assurez-vous de l'exactitude des données renseignées.</i></p>
                    
                    --> 
                        
                    <?php
                        echo '<input type="hidden" name="period" value="'.htmlentities($period).'">';
                        echo '<input type="hidden" name="person" value="'.htmlentities($person).'">';
                        echo '<input type="hidden" name="sex" value="'.htmlentities($sex).'">';
                        echo '<input type="hidden" name="part_fiscal" value="'.htmlentities(($part_fiscal + 1) / 2).'">';
                    ?>
                    <center><input type="submit" name="next_step" value="Valider" /></center>
                </form>
                <form method="post" action="inscription_2.php">
                    <?php
                        if ($_POST['next_step'])
                        {
                            echo '<input type="hidden" name="period" value="'.htmlentities($period).'">';
                            echo '<input type="hidden" name="person" value="'.htmlentities($person).'">';
                            echo '<input type="hidden" name="fname" value="'.htmlentities($fname).'">';
                            echo '<input type="hidden" name="lname" value="'.htmlentities($lname).'">';
                            echo '<input type="hidden" name="sex" value="'.htmlentities($sex).'">';
                            echo '<input type="hidden" name="birthday" value="'.htmlentities($birthday).'">';
                            echo '<input type="hidden" name="address" value="'.htmlentities($address).'">';
                            echo '<input type="hidden" name="address_plus" value="'.htmlentities($address_plus).'">';
                            echo '<input type="hidden" name="zip" value="'.htmlentities($zip).'">';
                            echo '<input type="hidden" name="city" value="'.htmlentities($city).'">';
                            echo '<input type="hidden" name="phone" value="'.htmlentities($phone).'">';
                            echo '<input type="hidden" name="GSM" value="'.htmlentities($gsm).'">';
                            echo '<input type="hidden" name="cb1" value="'.htmlentities($cb1).'">';
                            echo '<input type="hidden" name="cb2" value="'.htmlentities($cb2).'">';
                            echo '<input type="hidden" name="cb3" value="'.htmlentities($cb3).'">';
                            echo '<input type="hidden" name="cb4" value="'.htmlentities($cb4).'">';
                            echo '<input type="hidden" name="nb_inscrit" value="'.htmlentities($nb_inscrit).'">';
                            echo '<input type="hidden" name="mail" value="'.htmlentities($mail).'">';
                            echo '<input type="hidden" name="revenu_fiscal" value="'.htmlentities($revenu_fiscal).'">';
                            echo '<input type="hidden" name="part_fiscal" value="'.htmlentities($part_fiscal).'">';
                        }
                    ?>
                    <center><input style="margin-top: 5px;" type="submit" name="previous_step" value="Précédent" /></center>
                </form>

            </div>

            <?php include("html/footer.html"); ?>

        </div>

    </body>

</html>