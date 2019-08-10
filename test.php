<?php
require 'init.php';

use App\Models\Person;
use App\Models\Appointment;
use App\Utils;

$person = new Person('1');

echo '// Creating a person';

$person_data = array(
    'first_name' => 'Yuki',
    'last_name' => 'LE',
    'sex' => '0',
    'birthdate' => '2016-11-01',
    'address' => 'Vietnam',
    'postcode' => '84000',
    'city' => 'Hai Phong',
    'email' => 'lethehau@gmail.com',
    'phone' => '0767973163',
    'mobile' => '0767973163',
    'created_at' => date('Y-m-d H:i:s'),
    'updated_at' => date('Y-m-d H:i:s'),
);

$person_id = Utils::create_person($person_data);

echo '<pre>';
var_dump($person_data, $person_id);
echo '</pre>';

// Appointment
$appointment = new Appointment(1);

echo '<pre>';
var_dump($appointment);
echo '</pre>';

echo '// Creating an appointment';
$appointment_data = array(
    'person_id' => 1,
    'hour' => '09h30',
    'participants' => 2,
    'for_me' => 1,
    'for_my_family_members' => 1,
    'for_other_family_members' => 0
);

$appointment_id = Utils::create_appointment($appointment_data);

echo '<pre>';
var_dump($appointment_id);
echo '</pre>';