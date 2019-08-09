<?php
session_start();

if (!isset($_SESSION['password']))
    header('location: admin.php');

$subscribers_files = array();
$temp_data = array();
$subscribers_data = array();

$inc = 0;
if (file_exists('subs/pile.txt'))
{
    $pile = fopen('subs/pile.txt', 'r');
    while (!feof($pile))
    {
        $path = fgets($pile);
        $path = rtrim($path, "\r\n"); // Attention car fgets prends en compte \r\n, ce qui ne donne pas le bon chemin
        if ($path != '')
        {
            $subscribers_files[$inc] = 'subs/' . $path;
            $inc++;
        }
    }
    fclose($pile);

    $sort_items = array();
    $prev_sort_items = array();

    for ($i = 0; $i < count($subscribers_files); $i++)
    {
        if (file_exists($subscribers_files[$i]))
        {
            $file = fopen($subscribers_files[$i], 'r');
            $content = fread($file, filesize($subscribers_files[$i]));
            fclose($file);
            $j = 0;
            while (!(strpos($content, '<' . $j . '>') === FALSE))
            {
                $start = strpos($content, '<' . $j . '>') + strlen('<' . $j . '>');
                $length = strpos($content, '</' . $j . '>') - $start;
                $line = substr($content, $start, $length);
                $temp_data[$i][$j] = $line;
                $j++;
            }

            if ($_GET['sort'] == 0) // Par défaut
            {
                $prev_sort_items[$i] = $i;
                $sort_items[$i] = $i;
            }
            else if ($_GET['sort'] == 1) // Par nom
            {
                $prev_sort_items[$i] = $temp_data[$i][3];
                $sort_items[$i] = $temp_data[$i][3];
            }
            else if ($_GET['sort'] == 2) // Par prénom
            {
                $prev_sort_items[$i] = $temp_data[$i][2];
                $sort_items[$i] = $temp_data[$i][2];
            }
            else if ($_GET['sort'] == 3) // Par date de naissance
            {
                $prev_sort_items[$i] = $temp_data[$i][5];
                $sort_items[$i] = $temp_data[$i][5];
            }
            else if ($_GET['sort'] == 4) // Par heure de passage
            {
                $prev_sort_items[$i] = $temp_data[$i][19];
                $sort_items[$i] = $temp_data[$i][19];
            }
        }
    }

    if ($_GET['ascending'])
        rsort($sort_items);
    else
        sort($sort_items);

    for ($p = 0; $p < count($sort_items); $p++)
    {
        $index = array_search($sort_items[$p], $prev_sort_items);
        $subscribers_data[$p] = $temp_data[$index];
        unset($prev_sort_items[$index]);
    
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
                <h1>Espace administrateur - Liste des inscrits</h1>
                <p>Ci-dessous se trouve la liste des inscrits aux activités. Vous pouvez effectuer une action groupée ou spécifique à un inscrit.</p>
                <form method="get" action="admin_main_subscribers.php">
                    <center>
                        <label for="sort">Trier par </label>
                        <select name="sort" id="sort" style="width: 160px;">
                            <option value="0" <?php if($_GET['sort'] == 0) echo 'selected' ?>>Défaut</option>
                            <option value="1" <?php if($_GET['sort'] == 1) echo 'selected' ?>>Nom</option>
                            <option value="2" <?php if($_GET['sort'] == 2) echo 'selected' ?>>Prénom</option>
                            <option value="3" <?php if($_GET['sort'] == 3) echo 'selected' ?>>Date de naissance</option>
                            <option value="4" <?php if($_GET['sort'] == 4) echo 'selected' ?>>Heure de passage</option>
                        </select>
                        <label for="ascending"> et par ordre </label>
                        <select name="ascending" id="ascending" style="width: 120px;">
                            <option value="0" <?php if($_GET['ascending'] == 0) echo 'selected' ?>>Croissant</option>
                            <option value="1" <?php if($_GET['ascending'] == 1) echo 'selected' ?>>Décroissant</option>
                        </select>
                        <input type="submit" name="sort_list" value="Trier" />
                    </center>
                </form>
                <br/>
                <table style="width: 100%;border-collapse: collapse;">
                    <tr style="background: #FF9C0F;color: white;font-size: 1.1em;">
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th style="width: 160px;">Date de naissance</th>
                        <th style="width: 160px;">Heure de passage</th>
                        <th style="width: 160px;">Actions</th>
                    </tr>
                    <?php
                        for ($k = 0; $k < count($subscribers_files); $k++)
                        {
                            $color = ($k % 2 == 0) ? '#FFE9CA' : '#FFF4E6';
                            echo '
                                <tr style="background: ' . $color . ';">
                                    <td style="text-align: center;">' . utf8_encode($subscribers_data[$k][3]) . '</td>
                                    <td style="text-align: center;">' . utf8_encode($subscribers_data[$k][2]) . '</td>
                                    <td style="text-align: center;">' . $subscribers_data[$k][5] . '</td>
                                    <td style="text-align: center;">' . $subscribers_data[$k][19] . '</td>
                                    <td style="text-align: center;"><a href="admin_main_subscribers_view.php?file=' . str_replace('subs/', '', $subscribers_files[$k]) . '">Détails</a> - <a href="admin_main_subscribers_delete.php?file=' . str_replace('subs/', '', $subscribers_files[$k]) .'&id=' . utf8_encode($subscribers_data[$k][2]) . utf8_encode($subscribers_data[$k][3]) . '&doc1=' . str_replace('subs/', '', $subscribers_data[$k][16]) .'&doc2="' . str_replace('subs/', '', $subscribers_data[$k][17]) . '>Supprimer</a></td>
                                </tr>';
                        }
                    ?>        
                </table>
                <p style="text-align: center;"><a href="admin_main_subscribers_delete_all.php"><img src="resources/db_remove.png" style="width: 24px;margin: 0px 8px -7px 0;" />Supprimer tous les inscrits</a></p>
            </div>

            <?php include("html/footer.html"); ?>

        </div>

    </body>

</html>