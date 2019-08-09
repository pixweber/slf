<?php

if (file_exists('subs/pile.txt') && count(file('subs/pile.txt')) >= 200)
    header('Location: index.php');  

$isSubscribing = TRUE; // Affiche les étapes dans l'en-tête

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        
        <?php include("html/meta.html"); ?>

        <title>Inscription aux ateliers du Pôle Simon Le Franc</title>
    </head>

    <body>

        <script type="text/javascript">
            function Validate() {
                if (!(document.getElementById('cb1').checked && document.getElementById('cb2').checked)) {
                    alert("Vous devez accepter les conditions d'utilisation et d'inscription du service.");
                    return false;
                }
            }
        </script>

         <?php include("html/header.php"); ?>

        <div id="container">

            <div id="corps">

                <table style="width: 100%;">
                    <tr>
                        <td style="width: 50%;"><img style="width: 200px; margin-top: 10px; margin-left: -3px; margin-bottom: 10px;" src="resources/mairiedeparis.jpg" alt="Mairie de Paris" /></td>
                        <td style="width: 50%; margin-top: 15px;"><p style="padding: 0;float: right;margin-right: 10px;">Étape 1/4</p></td>
                    </tr>
                </table>
                <h1>Bienvenue</h1>
                <p style="text-align: justify;">Bienvenue sur le site internet du Centre Paris Anim’ Pôle Simon Le Franc destiné à générer une file d’attente pour le premier jour des inscriptions.                     <font size="5">Le samedi 9 septembre</font> <br/>
                    <br/>
                Le principe est de vous attribuer un horaire de rendez-vous auquel vous présenter le premier jour des inscriptions en fonction de votre ordre de connexion. Seules les 230 premières personnes connectés se verront attribuer un horaire de passage pour le premier jour des inscriptions. Ensuite les inscriptions se poursuivent aux horaires habituels d’ouverture du Pôle Simon Le Franc.
                    <br/>
                </p>
                
                <!--
                <p style="text-align: center;"><img src="resources/pdf_download.png" style="width: 30px; margin: 0px 8px -7px 0;" />
                    <a href="files/ci.pdf">Conditions d'inscription</a>
                     - 
                    <a href="files/tarifs.pdf">Tarifs</a>
                -->     
                </p>
                
                <center><p style="font-size: 1.8em; font-weight: bold;">ATTENTION ! Il ne s’agit pas d’une inscription en ligne.</p></center>
                
                
                <!--
                        champs obj formulaires 

                <p style="font-size: 0.8em;">Les champs marqués par une astérique rouge (<label style="color: red;">*</label>) sont nécessaires pour l'inscription.</p>
                --> 
                
                <!--<form method="post">
                        <table class="form" style="width: 100%">
                            <tr>
                                <td style="text-align: center;">
                                    <label class="star_field" for="period">Veuillez sélectionner la période souhaitée :</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">
                                    <select name="period" id="period" style="width: 100px;">
                                        <option value="year">Année</option>
                                        <option value="internship">Stage</option>
                                    </select>
                                    <script type="text/javascript">
                                        document.getElementById('period').value = "<?php if (empty($_POST['period'])) echo 'year'; else echo $_POST['period'];?>";
                                    </script>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">
                                    <label class="star_field" for="person">Veuillez sélectionner la personne concernée par les activités :</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">
                                    <select name="person" id="person" id="person" style="width: 100px;">
                                        <option value="child">Enfant</option>
                                        <option value="adult">Adulte</option>
                                    </select>
                                    <script type="text/javascript">
                                        document.getElementById('person').value = "<?php if (empty($_POST['person'])) echo 'child'; else echo $_POST['person'];?>";
                                    </script>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">
                                    <input type="submit" name="next" value="Valider">
                                </td>
                            </tr>
                        </table> 
                </form>-->

                <?php
                if (isset($_POST['next']))
                {
                    $period = $_POST['period'];
                    $person = $_POST['person'];
                    $link = 'http://'.$_SERVER['HTTP_HOST'] . dirname($_SERVER["REQUEST_URI"]);
                    $link = str_replace("\\", "/", $link);

                    if ($period == 'year')
                    {
                        if ($person == 'child')
                        {
                            echo '<h2>Planning des activités enfants annuelles</h2>';
                            $link = $link . '/files/planning_child_year.pdf';
                        }
                        else
                        {
                            echo '<h2>Planning des activités adultes annuelles</h2>';
                            $link = $link . '/files/planning_adult_year.pdf';
                        }
                    }
                    else
                    {
                        if ($person == 'child')
                        {
                            echo '<h2>Planning des stages enfants</h2>';
                            $link = $link . '/files/planning_child_internship.pdf';
                        }
                        else
                        {
                            echo '<h2>Planning des stages adultes</h2>';
                            $link = $link . '/files/planning_adult_internship.pdf';
                        }
                    }

                    echo '<iframe src="http://docs.google.com/gview?url=' . $link . '&embedded=true" style="width: 100%; height: 500px;" frameborder="0"></iframe>';
                    echo '<p style="text-align: center;"><a href="' . $link . '"><img src="resources/pdf_download.png" style="width: 30px; margin: 0px 8px -7px 0;" />Télécharger le planning</a></p>';
                }
                ?>

                <!--<form method="post" action="inscription_2.php">
                    <p>
                        <?php 
                        if (isset($_POST['next']))
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
                            echo ' Pour démarrer l\'inscription sur cette sélection, cliquez sur le bouton <i>Suivant</i>.';
                        }
                        ?>
                        
                    </p>
                    <?php
                        if (isset($_POST['next']))
                        {
                            echo '<center><input type="submit" name="next_step" value="Suivant"></center>';
                            echo '<input type="hidden" name="period" value="'.htmlentities($period).'">';
                            echo '<input type="hidden" name="person" value="'.htmlentities($person).'">';
                        }
                    ?>
                </form>-->

                <center>
                    <form method="post" action="inscription_2.php" onsubmit="return Validate();">
                        <input type="checkbox" id="cb1" value="cb1"><label class="star_field" for="cb1">J’ai compris et j’accepte les conditions d’utilisation de ce service.</label><br/><br/> <br/> 
                        <!--
                        <input type="checkbox" id="cb2" value="cb2"><label class="star_field" for="cb2">J’ai pris connaissance des conditions d’inscriptions et je les accepte.</label><br/><br/>
                        -->
                        
                        
                        <!-- grossir TOUS les bouttons de bas de page --> 
                        <input type="submit" name="next_step" value="C'est parti !" class="search"><br/>
                    </form>
                </center>

            </div>

            <?php include("html/footer.html"); ?>

        </div>

    </body>

</html>