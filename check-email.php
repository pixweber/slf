<?php
require 'init.php';
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use App\Core\Database;

// create a log channel
$log = new Logger('name');
$log->pushHandler(new StreamHandler('logs/check-email.log', Logger::WARNING));

// add records to the log
$log->warning(json_encode($_POST['email']));

if (!isset($_POST['confirm_email'])) {
    return;
}

$email = $_POST['confirm_email'];

// Check if email exists
$database = new Database();
$database->query("SELECT COUNT(*) as records_count FROM persons WHERE email='$email'");
$database->execute();
$result = $database->get_records();

// add records to the log
$log->warning(json_encode($result));

if ( $result[0]['records_count'] == 0) {
    echo 'true';
} else {
    echo 'false';
}