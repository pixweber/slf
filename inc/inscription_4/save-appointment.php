<?php
use App\Utils;

global $person_id;

// Save person data to the database
$appointment_data = array(
    'person_id' => $person_id,
    'hour' => get_current_available_hour(),
    'participants' => $_POST['nb_inscrit'],
    'for_me' => 1,
    'for_my_family_members' => 1,
    'for_other_family_members' => 0
);

$appointment_id = Utils::create_appointment($appointment_data);

echo '<pre>';
var_dump('Appointment saved', $appointment_id);
echo '</pre>';