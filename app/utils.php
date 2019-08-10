<?php
namespace App;

use App\Core\Database;

class Utils {
    public static function create_person($person_data) {
        $database = new Database();
        $query = "INSERT INTO persons(first_name, last_name, sex, birthdate, address, postcode, city, email, phone, mobile, created_at, updated_at) 
                    VALUES(:first_name,:last_name,:sex,:birthdate,:address,:postcode,:city,:email,:phone,:mobile,:created_at,:updated_at)";

        $database->query($query);

        echo '<pre>';
        var_dump($database);
        echo '</pre>';

        $database->bind(':first_name', $person_data['first_name']);
        $database->bind(':last_name', $person_data['last_name']);
        $database->bind(':sex', $person_data['sex']);
        $database->bind(':birthdate', $person_data['birthdate']);
        $database->bind(':address', $person_data['address']);
        $database->bind(':postcode', $person_data['postcode']);
        $database->bind(':city', $person_data['city']);
        $database->bind(':email', $person_data['email']);
        $database->bind(':phone', $person_data['phone']);
        $database->bind(':mobile', $person_data['mobile']);
        $database->bind(':created_at', $person_data['created_at']);
        $database->bind(':updated_at', $person_data['updated_at']);
        $database->execute();

        return $database->get_last_insert_id();
    }

    public static function create_appointment($person_data) {
        $database = new Database();
        $query = "INSERT INTO persons(first_name, last_name, sex, birthdate, address, postcode, city, email, phone, mobile, created_at, updated_at) 
                    VALUES(:first_name,:last_name,:sex,:birthdate,:address,:postcode,:city,:email,:phone,:mobile,:created_at,:updated_at)";

        $database->query($query);

        echo '<pre>';
        var_dump($database);
        echo '</pre>';

        $database->bind(':first_name', $person_data['first_name']);
        $database->bind(':last_name', $person_data['last_name']);
        $database->bind(':sex', $person_data['sex']);
        $database->bind(':birthdate', $person_data['birthdate']);
        $database->bind(':address', $person_data['address']);
        $database->bind(':postcode', $person_data['postcode']);
        $database->bind(':city', $person_data['city']);
        $database->bind(':email', $person_data['email']);
        $database->bind(':phone', $person_data['phone']);
        $database->bind(':mobile', $person_data['mobile']);
        $database->bind(':created_at', $person_data['created_at']);
        $database->bind(':updated_at', $person_data['updated_at']);
        $database->execute();

        return $database->get_last_insert_id();
    }
}