<?php
require 'init.php';

if ( get_registrations_count() >= 180) {
    header('Location: index.php');
}

// Affiche les étapes dans l'en-tête
$isSubscribing = TRUE;

// Write person and appointment information to the database
require 'inc/inscription_4/save-person.php';
require 'inc/inscription_4/save-appointment.php';

global $person_id;
$parental_permisson_filename = "$person_id" . "_" . strtolower($_POST['first_name']) . "_" . strtolower($_POST['last_name']);
$parental_permisson_filename = str_replace(' ', '_', $parental_permisson_filename);

if ( isset($_POST['next_step']) ) {

    // On commence par déterminer la position de l'utilisateur dans la pile
    $ext = array('.pdf', '.jpg', '.jpeg');
    $max_size = 2000000;

    if (isset($_FILES['droit_image']) && $_FILES['droit_image']['name'] != '')
    {
        $file_name = basename($_FILES['droit_image']['name']);
        $file_size = filesize($_FILES['droit_image']['tmp_name']);
        $file_ext = strrchr($_FILES['droit_image']['name'], '.');

        if (!in_array($file_ext, $ext))
             $output = 'Le format du fichier d\'autorisation d\'utilisation de l\'image est incorrect (seuls les fichiers PDF et images JPEG sont acceptés).';
        if ($file_size > $max_size)
             $output = 'Le fichier d\'autorisation d\'utilisation de l\'image est trop volumineux (taille limitée à 2000 Ko).';
        if (!isset($output))
        {
            $file_name = ReplaceSpecialCharacters($file_name);
            $file_name = preg_replace('/([^.a-z0-9]+)/i', '-', $file_name);
            $target_autor_file = '';
            if(!move_uploaded_file($_FILES['droit_image']['tmp_name'], 'uploads/' . $parental_permisson_filename . '_droit_image' . $file_ext))
                $output = 'Une erreur inconnue est survenue durant l\'envoi du fichier d\'autorisation d\'utilisation de l\'image au serveur. Contactez l\'administrateur du site pour plus d\'informations.';
            else
                $target_autor_file = 'upload/' . $parental_permisson_filename . '_droit_image' . $file_ext;
        }
    }

    if (isset($_FILES['autorisation_parent']) && $_FILES['autorisation_parent']['name'] != '') {
        $file_name = basename($_FILES['autorisation_parent']['name']);
        $file_size = filesize($_FILES['autorisation_parent']['tmp_name']);
        $file_ext = strrchr($_FILES['autorisation_parent']['name'], '.');

        if (!in_array($file_ext, $ext)) {
            $output = 'Le format du fichier d\'autorisation parentale est incorrect (seuls les fichiers PDF et images JPEG sont acceptés).';
        }

        if ($file_size > $max_size) {
            $output = 'Le fichier d\'autorisation parentale est trop volumineux (taille limitée à 2000 Ko).';
        }

        if (!isset($output)) {
            $file_name = ReplaceSpecialCharacters($file_name);
            $file_name = preg_replace('/([^.a-z0-9]+)/i', '-', $file_name);
            $target_parent_file = '';

            if(!move_uploaded_file($_FILES['autorisation_parent']['tmp_name'], 'uploads/' . $parental_permisson_filename . '_autorisation_parent' . $file_ext))
                $output = 'Une erreur inconnue est survenue durant l\'envoi du fichier d\'autorisation parentale au serveur. Contactez l\'administrateur du site pour plus d\'informations.';
            else {
                $target_parent_file = 'uploads/' . $parental_permisson_filename . '_autorisation_parent' . $file_ext;

                // Write parental file to database
                $database = new \App\Core\Database();
                $database->query("UPDATE persons SET parental_permission_file = '$target_parent_file' WHERE `person_id` = '$person_id'");
                $database->execute();
            }
        }
    }


    // Après l'ajout de l'utilisateur dans la base, on peut envoyer le mail
    // Sending mail with PHPMailer
    require 'inscription_4_send_email.php';

} else {
    header('Location: inscription_2.php');
}

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
                        <td style="width: 50%;"><img style="width: 200px; margin-top: 10px; margin-left: -3px; margin-bottom: 10px;" src="resources/mairiedeparis.jpg" alt="Mairie de Paris" /></td>
                        <td style="width: 50%; margin-top: 15px;"><p style="padding: 0;float: right;margin-right: 10px;">Étape 4/4</p></td>
                    </tr>
                </table>
                <h1>Attribution de votre horaire de RDV</h1>
                <?php
                    if (isset($output))
                    {
                        echo '<p>' . $output . '</p>';
                    }
                    else
                    {
                        echo '<p>Votre horaire de rendez-vous est : <b>' . $appointment_hour . '</b>.</p>';
                        
                        echo '<p style="text-align: justify;"><b>Vous allez recevoir par mail votre confirmation et votre plage horaire pour vous présenter à l’inscription et limiter votre délai d’attente.</b>
                        <br/><br/>
                        Pour chaque plage horaire vous serez entre 5 et 10 personnes invités à vous présenter à l’inscription.
                        Nous disposerons de 3 postes d’inscriptions pour permettre de traiter le maximum d’inscription le premier jour
                        L’équipe sera en possession d’une liste nominative des personnes attendues par plage horaire. 
                        <br/><br/>
                        Attention ce nouveau dispositif ne garantit pas de passer immédiatement. 
                        Pour garantir le bon fonctionnement nous vous remercions de respecter scrupuleusement cette plage horaire. Si vous êtes en retard l’inscription ne sera plus possible. 
                        Toute l’équipe vous remercie par avance pour votre compréhension et votre indulgence.
                        </p>';
                        echo '<br/>';
                        echo '<center><a style="font-size: 1.3em;" href="inscription_4_1.php">Pour que votre inscription soit possible vous devez apporter un dossier complet le samedi 9 septembre 2017</a></center>';
                        echo '<br/>';
                    }
                ?>
            </div>

            <?php include("html/footer.html"); ?>

        </div>

    </body>

</html>