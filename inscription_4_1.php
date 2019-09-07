<?php
$link = 'http://'.$_SERVER['HTTP_HOST'] . dirname($_SERVER["REQUEST_URI"]);
$link = str_replace("\\", "/", $link);
$link_sub = $link . '/files/inscription_sheet.docx';
//new link pour les doc à DL
$link_tarif = $link . '/files/inscription_sheet.docx';
$link_droitimg = $link . 'resources/pdf_download.png';
$link_planning = $link . '/files/tarifs.pdf';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
                        <td style="width: 50%;"><img style="width: 200px; margin-top: 10px; margin-left: -3px; margin-bottom: 10px;" src="assets/img/PARIS_LOGO-small.png" alt="Mairie de Paris" /></td>
                        <td style="width: 50%; margin-top: 15px;"><p style="padding: 0;float: right;margin-right: 10px;">Étape 4/4</p></td>
                    </tr>
                </table>
                <h1>Pour que votre dossier soit complet</h1>
                <br/>
                <p>Pour que nous puissions procéder à votre inscription vous devez fournir un <strong>dossier complet :</strong></p><br/>
                <ul>
                    <li><strong>1</strong> - Fiche d'inscription dûment complétée pour chaque personne inscrite</li> <br/>
                    
                    <li><strong>2</strong> - Justificatif de revenus par ordre de priorité : une attestation récente de la caisse des école indiquant le quotient familial pour le périscolaire, ou une attestation CAF (datant de moins de 3 mois) ou de votre avis d'imposition (Si aucun justificatifs apporté, le tarif maximum sera appliqué : QF10). </li><br/>
                    
                    <li><strong>3</strong> - Certificat médical pour les activités sportives (yoga, danse, éveil corporel, clown). </li> <br/>
                    
                    <li><strong>4</strong> - Une copier du carner de vaccination"à jour" pour l'activité jardinage. </li> <br/>
                    
                    </ul>
                
                <br/>
                <h2>Les pièces à télécharger</h2>
                    <ul>
                    <br/>
                    
                    <li>Remplir la fiche d'inscription <a href="<?php echo $link_sub; ?>" target="_blank">ici</a> (<b>une fiche d’inscription par personne</b>)</li>
                    
                    <li>Consulter les tarifs <a href="<?php echo $link_tarif ; ?>" target="_blank">ici</a></li>
                    
                    <li>Remplir la fiche de droit à l'image :<a href="<?php echo $link_droitimg ; ?>" target="_blank">ici</a></li>
                    
                    <li>Consulter le planning des ateliers <a href="<?php echo $link_planning; ?>" target="_blank">planning des ateliers</a></li>
                </ul>
                <br/>
                

                <center><p style="font-size: 1.2em; font-weight: bold;">Toute l’équipe vous remercie et vous accueillera avec plaisir pour cette nouvelle saison </p></center>
            </div>

            <?php include("html/footer.html"); ?>

        </div>

    </body>

</html>