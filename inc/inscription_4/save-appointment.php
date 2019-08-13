<?php
use App\Utils;

// Save person data to the database
$registration_options = convert_json_input_value_to_array($_POST['registration_options']);
$appointment_hour = get_current_available_hour();

$appointment_data = array(
    'person_id' => $person_id,
    'hour' => $appointment_hour,
    'participants' => $_POST['nb_inscrit'],
    'for_me' => in_array('for_me', $registration_options) ? '1' : '0',
    'for_my_family_members' => in_array('for_my_family_members', $registration_options) ? '1' : '0',
    'for_other_family_members' => in_array('for_other_family_members', $registration_options) ? '1' : '0'
);

$appointment_id = Utils::create_appointment($appointment_data);