<?php
session_start();

include('utils.php');

if (!isset($_SESSION['password']))
    header('location: admin.php');

if ($_POST['update'])
{
    $ext = array('.pdf', '.doc', '.docx');

    if (isset($_FILES['inscription_sheet']) && $_FILES['inscription_sheet']['name'] != '')
    {
        $file_size = filesize($_FILES['inscription_sheet']['tmp_name']);
        $file_ext = strrchr($_FILES['inscription_sheet']['name'], '.');

        if (!in_array($file_ext, $ext))
             $output = 'Le format du fichier envoyé est incorrect (seuls les fichiers PDF sont acceptés).';
        else if (!isset($output))
        {
            if(!move_uploaded_file($_FILES['inscription_sheet']['tmp_name'], 'files/inscription_sheet.pdf'))
                $output = 'Une erreur inconnue est survenue durant l\'envoi du fichier. Contactez l\'administrateur du site pour plus d\'informations.';
            else
                $output = 'Les fichiers ont été correctement mis à jour.';
        }
    }
    if (isset($_FILES['planning_adult_year']) && $_FILES['planning_adult_year']['name'] != '')
    {
        $file_size = filesize($_FILES['planning_adult_year']['tmp_name']);
        $file_ext = strrchr($_FILES['planning_adult_year']['name'], '.');

        if (!in_array($file_ext, $ext))
             $output = 'Le format du fichier envoyé est incorrect (seuls les fichiers PDF sont acceptés).';
        else if (!isset($output))
        {
            if(!move_uploaded_file($_FILES['planning_adult_year']['tmp_name'], 'files/planning_adult_year.pdf'))
                $output = 'Une erreur inconnue est survenue durant l\'envoi du fichier. Contactez l\'administrateur du site pour plus d\'informations.';
            else
                $output = 'Les fichiers ont été correctement mis à jour.';
        }
    }
    if (isset($_FILES['planning_child_internship']) && $_FILES['planning_child_internship']['name'] != '')
    {
        $file_size = filesize($_FILES['planning_child_internship']['tmp_name']);
        $file_ext = strrchr($_FILES['planning_child_internship']['name'], '.');

        if (!in_array($file_ext, $ext))
             $output = 'Le format du fichier envoyé est incorrect (seuls les fichiers PDF sont acceptés).';
        else if (!isset($output))
        {
            if(!move_uploaded_file($_FILES['planning_child_internship']['tmp_name'], 'files/planning_child_internship.pdf'))
                $output = 'Une erreur inconnue est survenue durant l\'envoi du fichier. Contactez l\'administrateur du site pour plus d\'informations.';
            else
                $output = 'Les fichiers ont été correctement mis à jour.';
        }
    }
    if (isset($_FILES['planning_adult_internship']) && $_FILES['planning_adult_internship']['name'] != '')
    {
        $file_size = filesize($_FILES['planning_adult_internship']['tmp_name']);
        $file_ext = strrchr($_FILES['planning_adult_internship']['name'], '.');

        if (!in_array($file_ext, $ext))
             $output = 'Le format du fichier envoyé est incorrect (seuls les fichiers PDF sont acceptés).';
        else if (!isset($output))
        {
            if(!move_uploaded_file($_FILES['planning_adult_internship']['tmp_name'], 'files/planning_adult_internship.pdf'))
                $output = 'Une erreur inconnue est survenue durant l\'envoi du fichier. Contactez l\'administrateur du site pour plus d\'informations.';
            else
                $output = 'Les fichiers ont été correctement mis à jour.';
        }
    }
    if (isset($_FILES['autor_parent']) && $_FILES['autor_parent']['name'] != '')
    {
        $file_size = filesize($_FILES['autor_parent']['tmp_name']);
        $file_ext = strrchr($_FILES['autor_parent']['name'], '.');

        if (!in_array($file_ext, $ext))
             $output = 'Le format du fichier envoyé est incorrect (seuls les fichiers PDF sont acceptés).';
        else if (!isset($output))
        {
            if(!move_uploaded_file($_FILES['autor_parent']['tmp_name'], 'files/autor_parent.pdf'))
                $output = 'Une erreur inconnue est survenue durant l\'envoi du fichier. Contactez l\'administrateur du site pour plus d\'informations.';
            else
                $output = 'Les fichiers ont été correctement mis à jour.';
        }
    }
    if (isset($_FILES['autor_image']) && $_FILES['autor_image']['name'] != '')
    {
        $file_size = filesize($_FILES['autor_image']['tmp_name']);
        $file_ext = strrchr($_FILES['autor_image']['name'], '.');

        if (!in_array($file_ext, $ext))
             $output = 'Le format du fichier envoyé est incorrect (seuls les fichiers PDF sont acceptés).';
        else if (!isset($output))
        {
            if(!move_uploaded_file($_FILES['autor_image']['tmp_name'], 'files/autor_image.pdf'))
                $output = 'Une erreur inconnue est survenue durant l\'envoi du fichier. Contactez l\'administrateur du site pour plus d\'informations.';
            else
                $output = 'Les fichiers ont été correctement mis à jour.';
        }
    }
    if (isset($_FILES['ci']) && $_FILES['ci']['name'] != '')
    {
        $file_size = filesize($_FILES['ci']['tmp_name']);
        $file_ext = strrchr($_FILES['ci']['name'], '.');

        if (!in_array($file_ext, $ext))
             $output = 'Le format du fichier envoyé est incorrect (seuls les fichiers PDF sont acceptés).';
        else if (!isset($output))
        {
            if(!move_uploaded_file($_FILES['ci']['tmp_name'], 'files/ci.pdf'))
                $output = 'Une erreur inconnue est survenue durant l\'envoi du fichier. Contactez l\'administrateur du site pour plus d\'informations.';
            else
                $output = 'Les fichiers ont été correctement mis à jour.';
        }
    }
    if (isset($_FILES['tarifs']) && $_FILES['tarifs']['name'] != '')
    {
        $file_size = filesize($_FILES['tarifs']['tmp_name']);
        $file_ext = strrchr($_FILES['tarifs']['name'], '.');

        if (!in_array($file_ext, $ext))
             $output = 'Le format du fichier envoyé est incorrect (seuls les fichiers PDF sont acceptés).';
        else if (!isset($output))
        {
            if(!move_uploaded_file($_FILES['tarifs']['tmp_name'], 'files/tarifs.pdf'))
                $output = 'Une erreur inconnue est survenue durant l\'envoi du fichier. Contactez l\'administrateur du site pour plus d\'informations.';
            else
                $output = 'Les fichiers ont été correctement mis à jour.';
        }
    }
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
                        <td style="width: 50%; margin-top: 15px;"><a href="admin_main.php" style="float: right;margin-right: 10px;">Retour au menu</a></td>
                    </tr>
                </table>
                <h1>Espace administrateur - Paramètres des fiches</h1>
                <p>Vous pouvez envoyer ci-dessous les fiches qui seront affichées aux utilisateurs par le biais du formulaire :</p>
                <?php
                    if (isset($output))
                    {
                        echo '<p>' . $output . '</p>';
                    }
                ?>
                <center>
                    <form method="post" action="admin_main_files.php" enctype="multipart/form-data">
                        <table>
                            <tr>
                                <td style="width: 50%;">
                                    <label for="ci">Conditions d'inscription :</label>
                                </td>
                                <td style="width: 50%;">
                                    <input type="file" name="ci" id="ci">
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 50%;">
                                    <label for="tarifs">Tarifs :</label>
                                </td>
                                <td style="width: 50%;">
                                    <input type="file" name="tarifs" id="tarifs">
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 50%;">
                                    <label for="inscription_sheet">Fiche d'inscription (*.docx) :</label>
                                </td>
                                <td style="width: 50%;">
                                    <input type="file" name="inscription_sheet" id="inscription_sheet">
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 50%;">
                                    <label for="planning_adult_year">Planning des ateliers :</label>
                                </td>
                                <td style="width: 50%;">
                                    <input type="file" name="planning_adult_year" id="planning_adult_year">
                                </td>
                            </tr>
                            <!--<tr>
                                <td style="width: 50%;">
                                    <label for="planning_child_internship">Planning des stages enfants :</label>
                                </td>
                                <td style="width: 50%;">
                                    <input type="file" name="planning_child_internship" id="planning_child_internship">
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 50%;">
                                    <label for="planning_adult_internship">Planning des stages adultes :</label>
                                </td>
                                <td style="width: 50%;">
                                    <input type="file" name="planning_adult_internship" id="planning_adult_internship">
                                </td>
                            </tr>-->
                            <tr>
                                <td style="width: 50%;">
                                    <label for="autor_parent">Fiche d'autorisation parentale :</label>
                                </td>
                                <td style="width: 50%;">
                                    <input type="file" name="autor_parent" id="autor_parent">
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 50%;">
                                    <label for="autor_image">Fiche d'autorisation d'utilisation de l'image :</label>
                                </td>
                                <td style="width: 50%;">
                                    <input type="file" name="autor_image" id="autor_image">
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <input style="margin-top: 5px;" type="submit" name="update" value="Mettre à jour" />
                    </form>
                </center>
                <br/>
            </div>

            <?php include("html/footer.html"); ?>

        </div>

    </body>

</html>