<?php
include('utils.php');

$dir = "./subs/";
$pattern = "#[0-9]{1,}.txt$#";
$patternEmail = '#^<12>#';
$patternHours = "#^<19>#";
$patternName = "#^<3>#";
$patternFirstname = "#^<2>#";

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


if (is_dir($dir)) {
  if ($dh = opendir($dir)) {
      while (($file = readdir($dh)) !== false) {
        if (preg_match($pattern, $file)) {
          $open = fopen($dir.$file, "r");
          while(!feof($open)){
            $read= fgets($open);
            if (preg_match($patternEmail, $read)) {
              $email = substr($read, 4, -6);
            }
            if (preg_match($patternHours, $read)) {
              $hours = substr($read, 4, -6);
            }
            if (preg_match($patternName, $read)) {
              $name = substr($read, 3, -5);
            }
            if (preg_match($patternFirstname, $read)) {
              $firstname = substr($read, 3, -5);
            }

          }
          fclose($open);

          $content .= "Votre heure de passage est à " . $hours . "\r\n\n";
          $content .= "Ceci est un message automatique, veuillez ne pas répondre.\r\n\n";
          $content .= "Pôle Simon le Franc - Mairie de Paris";

          if (!(file_exists('subs/send.txt'))){
            file_put_contents('subs/send.txt', '');
          }

          $names = fopen('subs/send.txt', 'r+');
          $read = fgets($names);
          $match = $firstname.$name;
          if (!preg_match("#".$match."#", $read)) {
            if (mail($email, $object, $content, $headers)) {
              fwrite($names, $match);
            }
          }
          fclose($names);

        }
      }
      closedir($dh);
    }
}
