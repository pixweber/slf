<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Config;
use App\Models\Person;

$mail = new PHPMailer();

global $appointment_hour;
global $person_id;

$person = new Person($person_id);

$subject = "Inscription aux activités du Pôle Simon le Franc - $appointment_hour le samedi 7 septembre 2019";
$email_content = file_get_contents("mails/after-registration-template.html");
$template_data = array(
    'appointment_hour' => $appointment_hour,
);

foreach($template_data as $key => $value) {
    $email_content = str_replace("[$key]", $value, $email_content);
}

try {
    //Server settings
    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = Config::SMTP_SERVER;  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = Config::SMTP_USERNAME;                     // SMTP username
    $mail->Password   = Config::SMTP_PASSWORD;                               // SMTP password
    $mail->SMTPSecure = Config::SMTP_SECURE;                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = Config::SMTP_PORT;                                    // TCP port to connect to

    $mail->CharSet = 'UTF-8';
    $mail->WordWrap = 120;

    //Recipients
    $mail->setFrom(Config::SMTP_FROM, Config::SMTP_SENDER_NAME);
    $mail->addReplyTo(Config::SMTP_REPLY_TO, Config::SMTP_SENDER_NAME);
    $mail->addAddress($person->getEmail(), $person->getLastName() . ' ' . $person->getFirstName());     // Add a recipient
    //$mail->addAddress('lethehau@gmail.com', $person->getLastName() . ' ' . $person->getFirstName());     // Add a recipient
    $mail->addBCC('lethehau@gmail.com', 'The Hau LE');

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $email_content;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    //echo 'Message has been sent';

} catch (Exception $exception) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    echo '<pre>';
    var_dump($exception);
    echo '</pre>';
}