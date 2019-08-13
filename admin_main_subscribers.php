<?php
header('Content-Type: text/html; charset=utf-8');

require 'init.php';

use App\Utils;

session_start();

if (!isset($_SESSION['password'])) {
    header('location: admin.php');
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
                <h1>Espace administrateur - Liste des inscrits</h1>
                <p>Ci-dessous se trouve la liste des inscrits aux activités. Vous pouvez effectuer une action groupée ou spécifique à un inscrit.</p>
                <script type="text/javascript">
                    $(document).ready(function(){
                        //Set selected for sort by select and sort order
                        var sort_by = getParameterByName('sort', window.location.url);
                        var order = getParameterByName('ascending', window.location.url);
                        $('select#sort_by option[value="'+sort_by+'"]').attr("selected","selected");
                        $('select#sort_order option[value="'+order+'"]').attr("selected","selected");
                    });
                </script>
                <br/>

                <table style="width: 100%; margin-top: 15px;">
                    <tbody><tr>
                        <td width="60%">
                            <form method="get" action="admin_main_subscribers.php">
                                <center>
                                    <label for="sort">Trier par </label>
                                    <select id="sort_by" name="sort" id="sort" style="width: 160px;">
                                        <option value="">Défaut</option>
                                        <option value="last_name">Nom</option>
                                        <option value="first_name">Prénom</option>
                                        <option value="birthdate">Date de naissance</option>
                                        <option value="hour">Heure</option>
                                    </select>
                                    <label for="ascending"> et par ordre </label>
                                    <select id="sort_order" name="ascending" id="ascending" style="width: 120px;">
                                        <option value="asc">Croissant</option>
                                        <option value="desc">Décroissant</option>
                                    </select>
                                    <input type="submit" name="sort_list" value="Trier" />
                                </center>
                            </form>
                        </td>
                        <td width="40%">
                            <div style="text-align: right; padding-right: 20px;"><a href="generate_excel.php" _target="_blank"><img src="/assets/img/icon_excel.jpg" style="width: 24px;margin: 0px 8px -7px 0;">Télécharger le fichier Excel</a></div>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <div class="padding-20">
                    <table id="appointments-table" style="width: 100%;border-collapse: collapse;">
                        <tr style="background: #FF9C0F;color: white;font-size: 1.1em;">
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Portable</th>
                            <th style="width: 160px;">Date de naissance</th>
                            <th style="">Heure</th>
                            <th style="width: 350px;">Actions</th>
                        </tr>
                        <?php
                        $appointments = null;
                        $sort_by = isset($_GET['sort']) ? $_GET['sort'] : '';
                        $sort_order = isset($_GET['ascending']) ? $_GET['ascending'] : '';
                        $appointments = Utils::get_all_appointments($sort_by, $sort_order);

                        if ($appointments) :
                            foreach ($appointments as $appointment) :
                                ?>
                                <tr>
                                    <td style=""><?php echo strtoupper($appointment['last_name']); ?></td>
                                    <td style=""><?php echo $appointment['first_name']; ?></td>
                                    <td style=""><?php echo $appointment['email']; ?></td>
                                    <td style="text-align: center;"><?php echo $appointment['mobile']; ?></td>
                                    <td style="text-align: center;"><?php echo DateTime::createFromFormat('Y-m-d', $appointment['birthdate'])->format('d/m/Y'); ?></td>
                                    <td style="text-align: center;"><?php echo $appointment['hour']; ?></td>
                                    <td style="text-align: center;">
                                        <a href="admin_main_subscribers_view.php?appointment_id=<?php echo $appointment['appointment_id']; ?>">Détails</a> -
                                        <a class="delete-appointment" href="admin_main_subscribers_delete.php?appointment_id=<?php echo $appointment['appointment_id']; ?>">Supprimer</a>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                        else :
                            ?>
                            <div>Actuellement il n'y a pas de pré-inscription</div>
                        <?php
                        endif;
                        ?>

                    </table>
                </div>

                <table style="width: 100%;">
                    <tbody><tr>
                        <td width="50%">
                            <p style="text-align: center;"><a href="#" onclick="sure();"><img src="/resources/db_remove.png" style="width: 24px;margin: 0px 8px -7px 0;">Supprimer tous les inscrits</a></p>
                        </td>
                        <td width="50%">
                            <p style="text-align: center;"><a href="generate_excel.php" _target="_blank"><img src="/assets/img/icon_excel.jpg" style="width: 24px;margin: 0px 8px -7px 0;">Télécharger le fichier Excel</a></p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <?php include("html/footer.html"); ?>

        </div>

    </body>

</html>