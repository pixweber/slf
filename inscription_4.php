<?php
require 'init.php';

echo '<pre>';
var_dump($_POST);
echo '</pre>';

if (file_exists('subs/pile.txt') && count(file('subs/pile.txt')) >= 200)
    header('Location: index.php'); 

$isSubscribing = TRUE; // Affiche les étapes dans l'en-tête

if (!(file_exists('subs/noms.txt')))
        file_put_contents('subs/noms.txt', '');
$names = fopen('subs/noms.txt', 'r');
$match = $_POST['first_name'] . $_POST['last_name'];

if (strpos(file_get_contents('subs/noms.txt'), $match) !== FALSE) {
    $output = 'Cette personne est déjà inscrite aux activités.';
}

fclose($names); 

if ( $_POST['next_step'] /*&& !isset($output)*/ ) {
    $LIFO = fopen('subs/pile.txt', (file_exists('subs/pile.txt')) ? 'a' : 'w');
    // On commence par déterminer la position de l'utilisateur dans la pile
    $i = 1;
    while (file_exists('subs/' . $i . '.txt'))
        $i++;
    $target_name = $i . '.txt';

    $ext = array('.pdf', '.jpg', '.jpeg');
    $max_size = 2000000;

    fwrite($LIFO, $target_name . PHP_EOL);
    fclose($LIFO);

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
            if(!move_uploaded_file($_FILES['droit_image']['tmp_name'], 'subs/' . $i . '_droit_image' . $file_ext))
                $output = 'Une erreur inconnue est survenue durant l\'envoi du fichier d\'autorisation d\'utilisation de l\'image au serveur. Contactez l\'administrateur du site pour plus d\'informations.';
            else
                $target_autor_file = 'subs/' . $i . '_droit_image' . $file_ext;
        }
    }

    if (isset($_FILES['autorisation_parent']) && $_FILES['autorisation_parent']['name'] != '')
    {
        $file_name = basename($_FILES['autorisation_parent']['name']);
        $file_size = filesize($_FILES['autorisation_parent']['tmp_name']);
        $file_ext = strrchr($_FILES['autorisation_parent']['name'], '.');

        if (!in_array($file_ext, $ext))
             $output = 'Le format du fichier d\'autorisation parentale est incorrect (seuls les fichiers PDF et images JPEG sont acceptés).';
        if ($file_size > $max_size)
             $output = 'Le fichier d\'autorisation parentale est trop volumineux (taille limitée à 2000 Ko).';
        if (!isset($output))
        {
            $file_name = ReplaceSpecialCharacters($file_name);
            $file_name = preg_replace('/([^.a-z0-9]+)/i', '-', $file_name);
            $target_parent_file = '';
            if(!move_uploaded_file($_FILES['autorisation_parent']['tmp_name'], 'subs/' . $i . '_autorisation_parent' . $file_ext))
                $output = 'Une erreur inconnue est survenue durant l\'envoi du fichier d\'autorisation parentale au serveur. Contactez l\'administrateur du site pour plus d\'informations.';
            else
                $target_parent_file = 'subs/' . $i . '_autorisation_parent' . $file_ext;
        }
    }

    // Write to text file
    if (!isset($output)) {

        $data = array();
    
        $data[0] = $_POST['period'];
        $data[1] = $_POST['person'];
        $data[2] = $_POST['first_name'];
        $data[3] = $_POST['last_name'];
        $data[4] = $_POST['sex'];
        $data[5] = $_POST['birthday'];
        $data[6] = $_POST['address'];
        $data[7] = $_POST['address_plus'];
        $data[8] = $_POST['zip'];
        $data[9] = $_POST['city'];
        $data[10] = $_POST['phone'];
        $data[11] = $_POST['mobile'];
        $data[12] = $_POST['email'];
        $data[13] = $_POST['registration_options'];
        $data[16] = $target_autor_file;
        $data[17] = $target_parent_file;
        $data[18] = date('d/m/Y H:m:s');
        $data[19] = GetDateByLIFOIndex(count(file('subs/pile.txt'))); // Heure de passage
        $data[20] = $_POST['nb_inscrit'];

        $file_data = fopen('subs/' . $target_name, 'w');
        for ($i = 0; $i < count($data); $i++) {
            fwrite($file_data, '<' . $i . '>' . $data[$i] . '</' . $i . '>' . PHP_EOL);
        }

        fclose($file_data);

        $names = fopen('subs/noms.txt', 'a');
        fwrite($names, $match);
        fclose($names);

        // Après l'ajout de l'utilisateur dans la base, on peut envoyer le mail
        $headers = 'From:PoleSimonLeFranc' . "\r\n";
        $headers .= 'X-Mailer:PHP/'. phpversion();
        $object = "Inscription aux activités du Pôle Simon le Franc";
        $content = "Merci pour votre inscription aux activités du Pôle Simon le Franc." . "/r/n";
        $content .= "Pour chaque plage horaire vous serez entre 5 et 10 personnes invités à vous présenter à l’inscription. ".
            "Nous disposerons de 3 postes d’inscriptions pour permettre de traiter le maximum d’inscription le premier jour ".
            "L’équipe sera en possession d’une liste nominative des personnes attendues par plage horaire.\r\n".
            "Attention ce nouveau dispositif ne garantit pas de passer immédiatement. ".
            "Pour garantir le bon fonctionnement nous vous remercions de respecter scrupuleusement cette plage horaire. Si vous êtes en retard l’inscription ne sera plus possible. ".
            "Toute l’équipe vous remercie par avance pour votre compréhension et votre indulgence.\r\n";
        $content .= "Votre heure de passage est à " . $data[19] . "\r\n\n";
        $content .= "Ceci est un message automatique, veuillez ne pas répondre.\r\n\n";
        $content .= "Pôle Simon le Franc - Mairie de Paris";

        mail($data[12], $object, $content, $headers);
        /*if (mail($data[12], $object, $content, $headers))
            echo "Message envoyé";
        else
            echo "Erreur !";*/
    }

    // Write person and appointment information to the database
    require 'inc/inscription_4/save-person.php';
    require 'inc/inscription_4/save-appointment.php';

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
                        echo '<p>Votre horaire de rendez-vous est : <b>' . $data[19] . '</b>.</p>';
                        
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