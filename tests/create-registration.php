<?php
$time1 = microtime(true);
require '../init.php';

use App\Utils;
use Faker\Factory;
use App\Config;

for ($i = 1; $i <= 5; $i++) {

    // Check if registration limit reached
    if ( get_registrations_count() >= 200 ) {
        echo '<p>Registration limit reached</p>';
        break;
    }

    $faker = Factory::create('fr_FR');

    $registration_options = array(
        "['for_me']",
        "['for_my_family_members'",
        "'for_other_family_members']",
        "['for_me','for_my_family_members'",
        "['for_me',,'for_other_family_members']",
        "['for_me','for_my_family_members','for_other_family_members']",
    );

    $test_data = array(
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'sex' => $faker->boolean == true ? 'M' : 'F',
        'birthday' => $faker->date('d/m/Y'),
        'address' => $faker->address,
        'address_plus' => $faker->streetAddress,
        'zip' => $faker->postcode,
        'city' => $faker->city,
        'phone' => $faker->phoneNumber,
        'mobile' => $faker->phoneNumber,
        'email' => $faker->email,
        'registration_options' => $registration_options[mt_rand(0,5)],
        'nb_inscrit' => $faker->numberBetween(1,5),
        'next_step' => 'Valider'
    );

    send_post_request(Config::SITE_URL . '/inscription_4.php', $test_data);
}



$time2 = microtime(true);
echo 'Script execution time: ' . ($time2 - $time1); //value in seconds