<?php
session_start();
if (!isset($_SESSION['password'])) {
    header('location: admin.php');
}

require 'init.php';

use App\Tools\XLSXWriter;
use App\Utils;

$header = array(
    'Numéro RDV' => 'integer',//text
    'Heure' => '@',
    'Participants' => 'integer',
    'Prénom' => 'GENERAL',//text
    'Nom' => 'GENERAL',
    'Email' => '@',
    'Portable' => '@',
    'Téléphone' => '@',
    'Date de Naissance' => 'dd-mm-yyyy', //custom
    'Autorisation parentale' => '@'
);

$rows = Utils::get_all_appointments_to_export();

$writer = new XLSXWriter();
$writer->writeSheetHeader('Sheet1', $header);

foreach ($rows as $row) {
    $custom_row = array(
        $row['appointment_id'],
        $row['hour'],
        $row['participants'],
        $row['first_name'],
        $row['last_name'],
        $row['email'],
        $row['mobile'],
        $row['phone'],
        $row['birthdate'],
        $row['parental_permission_file'],
    );
    $writer->writeSheetRow('Sheet1', $custom_row);
}

//$writer->writeSheet($rows,'Sheet1', $header);//or write the whole sheet in 1 call
$file_path = 'export/list-des-inscrits.xlsx';
$writer->writeToFile($file_path);

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="'. basename($file_path).'"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file_path));
flush(); // Flush system output buffer
readfile($file_path);
exit;