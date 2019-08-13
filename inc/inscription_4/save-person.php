<?php
use App\Utils;

// Save person data to the database
$person_data = array(
    'first_name' => $_POST['first_name'],
    'last_name' => $_POST['last_name'],
    'sex' => $_POST['sex'] === 'M' ? '1' : '0',
    'birthdate' => DateTime::createFromFormat('d/m/Y',$_POST['birthday'])->format('Y-m-d'),
    'address' => $_POST['address'],
    'address_plus' => isset($_POST['address_plus']) ? $_POST['address_plus'] : '',
    'postcode' => $_POST['zip'],
    'city' => $_POST['city'],
    'email' => $_POST['email'],
    'phone' => $_POST['phone'],
    'mobile' => $_POST['mobile'],
    'created_at' => date('Y-m-d H:i:s'),
    'updated_at' => date('Y-m-d H:i:s')
);

$person_id = Utils::create_person($person_data);