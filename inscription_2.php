<?php
    
if (file_exists('subs/pile.txt') && count(file('subs/pile.txt')) >= 200)
    header('Location: index.php');  

$isSubscribing = TRUE; // Affiche les étapes dans l'en-tête

$period = $_POST['period'];
$person = $_POST['person'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        
        <?php include("html/meta.html"); ?>

        <title>Inscription aux ateliers du Pôle Simon Le Franc</title>
    </head>

    <body>

        <script lang="Javascript">

            function CheckInputs() {
                if (document.forms['form'].fname.value == "" ||
                    document.forms['form'].lname.value == "" ||
                    //document.forms['form'].birthday.value == "" ||
                    document.forms['form'].address.value == "" ||
                    document.forms['form'].zip.value == "" ||
                    document.forms['form'].city.value == "" ||
                    document.forms['form'].GSM.value == "" ||
                    document.forms['form'].mail.value == "" ||
                    document.forms['form'].nb_inscrit.value == "") {
                    alert("Certains champs obligatoires n'ont pas été remplis.");
                    return false;
                }
                else if (!document.forms["form"].birthday.value.match(/^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/g)) {
                    alert("La saisie de la date de naissance est invalide. Veuillez inscrire la date de naissance au format suivant : JJ/MM/AAAA");
                    return false;
                }
                else if (!document.forms["form"].mail.value.match(/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/)) {
                    alert("Le format de l'adresse mail est incorrecte.");
                    return false;
                }
                else if (document.forms["form"].GSM.value.length != 10) {
                    alert("Le numéro de téléphone portable nécessite 10 chiffres.");
                    return false;
                }
                else if (document.forms["form"].phone.value.length > 0 && document.forms["form"].phone.value.length != 10) {
                    alert("Le numéro de téléphone fixe nécessite 10 chiffres.");
                    return false;
                }
                else if (document.forms['form'].revenu_fiscal.value.length != "") {
                    if (parseFloat(document.forms['form'].revenu_fiscal.value) < 0) {
                        alert("Le revenu fiscal de référence ne peut pas être inférieur à 0 euros.");
                        return false;
                    }
                }
                else if (!document.getElementById('cb1').checked && !document.getElementById('cb2').checked &&
                        !document.getElementById('cb3').checked && !document.getElementById('cb4').checked) {
                    alert("Au moins une personne doit être inscrite.");
                    return false;
                }
                else if (document.forms['form'].nb_inscrit.value != "") {
                    var val = parseFloat(document.forms['form'].nb_inscrit.value);
                    if (val != Math.round(val)) {
                        alert("Le nombre de personnes inscrites doit être un nombre entier.");
                        return false;
                    }
                    else if (val <= 0) {
                        alert("Il ne peut y avoir moins d'une personne inscrite.");
                        return false;
                    }
                }
                return true;
            }


        </script>

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

                <!--<p>
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
                            echo ' Pour modifier ce choix, vous pouvez retourner sur la page précédente en cliquant sur le bouton <i>Précédent</i>.';
                        }
                        ?>
                        
                    </p>-->
                <p style="font-size: 0.8em;">Les champs marqués par une astérique rouge (<label style="color: red;">*</label>) sont nécessaires pour l'inscription.</p>
                <form name="form" method="post" action="inscription_3.php" onsubmit="return CheckInputs();">
                    <fieldset>
                        <legend>Identité</legend>
                        <table class="form" style="width: 100%">
                            <tr>
                                <td style="width: 10%;">
                                    <label class="star_field" for="lname">Nom :</label>
                                </td>
                                <td style="width: 40%;">
                                    <input style="float: right; width: 100%;margin-right: 10px;" type="text" name="lname" id="lname">
                                    <script type="text/javascript">
                                        document.getElementById('lname').value = "<?php if (empty($_POST['lname'])) echo ''; else echo $_POST['lname'];?>";
                                    </script>
                                </td>
                                <td style="width: 13%;">
                                    <label class="star_field" for="fname">Prénom :</label>
                                </td>
                                <td style="width: 37%;">
                                    <input style="float: right; width: 100%;" type="text" name="fname" id="fname">
                                    <script type="text/javascript">
                                        document.getElementById('fname').value = "<?php if (empty($_POST['fname'])) echo ''; else echo $_POST['fname'];?>";
                                    </script>
                                </td>
                            </tr>
                            <tr>
                            <!--    
                                <td colspan="2" style="width: 50%;">
                                    <label class="star_field" for="sex">Sexe :</label>
                                    <input type="radio" name="sex" value="M" checked >M
                                    <input type="radio" name="sex" value="F">F    
                                </td>
                                
                                <td colspan="2" style="width: 50%;">
                                    <label class="star_field" for="fname">Date de naissance :</label>
                                    <input type="text" name="birthday" id="birthday" />
                                    <script type="text/javascript">
                                        document.getElementById('birthday').value = "<?php if (empty($_POST['birthday'])) echo ''; else echo $_POST['birthday'];?>";
                                    </script>
                                </td>
                            -->
                                
                            </tr>
                        </table>
                    </fieldset>
                    <fieldset>
                        <legend>Coordonnées</legend>
                        <table class="form" style="width: 100%">
                            
                            <!--
                            <tr>
                                
                                <td style="width: 200px;">
                                    <label class="star_field" for="address">Adresse :</label>
                                </td>
                                
                                <td>
                                    <input style="width: 100%;" type="text" name="address" id="address"> 
                                    <script type="text/javascript">
                                        document.getElementById('address').value = "<?php if (empty($_POST['address'])) echo ''; else echo $_POST['address'];?>";
                                    </script>
                                </td>
                                
                            </tr>
                            <tr>
                                <td style="width: 200px;">
                                    <label for="address_plus">Complément d'adresse :</label>
                                </td>
                                
                                <td>
                                    <input style="width: 100%;" type="text" name="address_plus" id="address_plus"> 
                                    <script type="text/javascript">
                                        document.getElementById('address_plus').value = "<?php if (empty($_POST['address_plus'])) echo ''; else echo $_POST['address_plus'];?>";
                                    </script>
                                </td>
                            </tr>
                        </table>
                        <table class="form" style="width: 100%">
                            
                            <tr>
                                <td style="width: 140px;">
                                    <label class="star_field" for="zip">Code Postal :</label>
                                </td>
                                <td>
                                    <input style="width: 90%;" type="text" name="zip" id="zip"> 
                                    <script type="text/javascript">
                                        document.getElementById('zip').value = "<?php if (empty($_POST['zip'])) echo ''; else echo $_POST['zip'];?>";
                                    </script>
                                </td>
                                <td style="width: 90px;">
                                    <label class="star_field" for="city">Ville :</label>
                                </td>
                                <td>
                                    <input style="width: 100%;" type="text" name="city" id="city"> 
                                    <script type="text/javascript">
                                        document.getElementById('city').value = "<?php if (empty($_POST['city'])) echo ''; else echo $_POST['city'];?>";
                                    </script>
                                </td>
                            </tr>
                            -->
                            <tr>
                                <td style="width: 140px;">
                                    <label for="phone">Téléphone (fixe) :</label>
                                </td>
                                <td>
                                    <input style="width: 90%;" type="text" name="phone" id="phone"> 
                                    <script type="text/javascript">
                                        document.getElementById('phone').value = "<?php if (empty($_POST['phone'])) echo ''; else echo $_POST['phone'];?>";
                                    </script>
                                </td>
                                <td style="width: 90px;">
                                    <label class="star_field" for="GSM">Portable :</label>
                                </td>
                                <td>
                                    <input style="width: 100%;" type="text" name="GSM" id="GSM"> 
                                    <script type="text/javascript">
                                        document.getElementById('GSM').value = "<?php if (empty($_POST['GSM'])) echo ''; else echo $_POST['GSM'];?>";
                                    </script>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 140px;">
                                    <label class="star_field" for="mail">Adresse mail :</label>
                                </td>
                                <td colspan="3">
                                    <input style="width: 100%;" type="text" name="mail" id="mail"> 
                                    <script type="text/javascript">
                                        document.getElementById('mail').value = "<?php if (empty($_POST['mail'])) echo ''; else echo $_POST['mail'];?>";
                                    </script>
                                </td>
                            </tr>
                            
                            <tr>
                                <td style="width: 140px;">
                                    <label class="star_field" for="mail">Confirmation :</label>
                                </td>
                                <td colspan="3">
                                    <input style="width: 100%;" type="text" name="mail" id="mail"> 
                                    <script type="text/javascript">
                                        document.getElementById('mail').value = "<?php if (empty($_POST['mail'])) echo ''; else echo $_POST['mail'];?>";
                                    </script>
                                </td>
                            </tr>
                            
                        </table>
                    </fieldset>
                    <fieldset>
                        <legend>Personnes à inscrire</legend>
                        <input type="checkbox" id="cb1" name="cb1" <?php if($_POST['cb1'] === 'on') echo 'checked="checked"';?>><label for="cb1">Je m’inscris.</label><br/>
                        <input type="checkbox" id="cb2" name="cb2" <?php if($_POST['cb2'] === 'on') echo 'checked="checked"';?>><label for="cb2">J’inscris les membres de ma famille.</label><br/>
                        <!--
                        <input type="checkbox" id="cb3" name="cb3" <?php if($_POST['cb3'] === 'on') echo 'checked="checked"';?>><label for="cb3">J’inscris une autre personne.</label><br/>
                        --> 
                        <input type="checkbox" id="cb4" name="cb4" <?php if($_POST['cb4'] === 'on') echo 'checked="checked"';?>><label for="cb4">J’inscris les membres d’une autre famille.</label><br/><br/>
                        <table class="form" style="width: 100%">
                            <tr>
                                <td style="width: 190px;">
                                    <label class="star_field" for="nb_inscrit">Nombre d'inscriptions :</label>
                                </td>
                                <td>
                                    <input style="width: 20%;" type="text" name="nb_inscrit" id="nb_inscrit" value="<?php if (empty($_POST['nb_inscrit'])) echo ''; else echo $_POST['nb_inscrit'];?>"> 
                                    <script type="text/javascript">
                                        document.getElementById('nb_inscrit').value = "<?php if (empty($_POST['nb_inscrit'])) echo ''; else echo $_POST['nb_inscrit'];?>";
                                    </script>
                                </td>
                            <tr/>
                        </table>
                        
                        
                        
                        
                        <!-- CHECK FONCTION PHP POUR LIMITER LA SAISI A 5 PERSONNES  --> 
                        <center><p style="text-decoration: underline;">Attention vous ne pouvez inscrire les membres que d’une seule autre famille et dans la limite de <strong>5 </strong> personnes maximum.</p></center>
                    </fieldset>
                    <br/> <br/> 
                    
                    <!--
                    <fieldset>
                        <legend>Quotient Familial (Facultatif)</legend>
                            <table class="form" style="width: 100%">
                                <tr>
                                    <td style="width: 30%">
                                        <label for="revenu_fiscal">Revenu fiscal de référence :</label>
                                    </td>
                                    <td style="width: 20%">
                                        <input style="width: 70%;" type="text" name="revenu_fiscal" id="revenu_fiscal"> €
                                        <script type="text/javascript">
                                            document.getElementById('revenu_fiscal').value = "<?php if (empty($_POST['revenu_fiscal'])) echo ''; else echo $_POST['revenu_fiscal'];?>";
                                        </script>
                                    </td>
                                    <td style="width: 30%">
                                        <label for="part_fiscal">Parts fiscales :</label>
                                    </td>
                                    <td style="width: 20%">
                                        <select name="part_fiscal" id="part_fiscal" style="width: 100%;">
                                            <option value="1" <?php if($_POST['part_fiscal'] == 1) echo 'selected' ?>>1</option>
                                            <option value="2" <?php if($_POST['part_fiscal'] == 2) echo 'selected' ?>>1,5</option>
                                            <option value="3" <?php if($_POST['part_fiscal'] == 3) echo 'selected' ?>>2</option>
                                            <option value="4" <?php if($_POST['part_fiscal'] == 4) echo 'selected' ?>>2,5</option>
                                            <option value="5" <?php if($_POST['part_fiscal'] == 5) echo 'selected' ?>>3</option>
                                            <option value="6" <?php if($_POST['part_fiscal'] == 6) echo 'selected' ?>>3,5</option>
                                            <option value="7" <?php if($_POST['part_fiscal'] == 7) echo 'selected' ?>>4</option>
                                            <option value="8" <?php if($_POST['part_fiscal'] == 8) echo 'selected' ?>>4,5</option>
                                            <option value="9" <?php if($_POST['part_fiscal'] == 9) echo 'selected' ?>>5</option>
                                            <option value="10" <?php if($_POST['part_fiscal'] == 10) echo 'selected' ?>>5,5</option>
                                            <option value="11" <?php if($_POST['part_fiscal'] == 11) echo 'selected' ?>>6</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                    </fieldset>
                    -->
                    
                    <?php
                        echo '<input type="hidden" name="period" value="'.htmlentities($period).'">';
                        echo '<input type="hidden" name="person" value="'.htmlentities($person).'">';
                    ?>
                    <center><input type="submit" name="next_step" value="Suivant" class="search" /></center>
                </form>
                
                <form method="post" action="inscription_1.php">
                    <center><input style="margin-top: 5px;" type="submit" name="previous_step" value="Précédent" /></center>
                    <?php
                        if (isset($_POST['next_step']))
                        {
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