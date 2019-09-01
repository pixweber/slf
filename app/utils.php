<?php
namespace App;

use App\Core\Database;
use App\Models\Appointment;
use App\Models\Person;

class Utils {

    /**
     * @param $person_data
     * @return int
     */
    public static function create_person($person_data) {
        $database = new Database();
        $query = "INSERT INTO slf_persons(first_name, last_name, sex, birthdate, address, address_plus, postcode, city, email, phone, mobile, created_at, updated_at) 
                    VALUES(:first_name,:last_name,:sex,:birthdate,:address,:address_plus,:postcode,:city,:email,:phone,:mobile,:created_at,:updated_at)";

        $database->query($query);

        $database->bind(':first_name', $person_data['first_name']);
        $database->bind(':last_name', $person_data['last_name']);
        $database->bind(':sex', $person_data['sex']);
        $database->bind(':birthdate', $person_data['birthdate']);
        $database->bind(':address', $person_data['address']);
        $database->bind(':address_plus', $person_data['address_plus']);
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

    /**
     * @param $appointment_data
     * @return int
     */
    public static function create_appointment($appointment_data) {
        $database = new Database();
        $query = "INSERT INTO slf_appointments(person_id, hour, participants, for_me, for_my_family_members, for_other_family_members) 
                    VALUES(:person_id, :hour, :participants, :for_me, :for_my_family_members, :for_other_family_members)";

        $database->query($query);

        $database->bind(':person_id', $appointment_data['person_id']);
        $database->bind(':hour', $appointment_data['hour']);
        $database->bind(':participants', $appointment_data['participants']);
        $database->bind(':for_me', $appointment_data['for_me']);
        $database->bind(':for_my_family_members', $appointment_data['for_my_family_members']);
        $database->bind(':for_other_family_members', $appointment_data['for_other_family_members']);
        $database->execute();

        return $database->get_last_insert_id();
    }

    /**
     * @param string $sort_by
     * @param string $order
     * @return array
     */
    public static function get_all_appointments($sort_by, $order) {
        $database = new Database();
        $query = "SELECT appointment_id, slf_persons.person_id as person_id, `hour`, participants, first_name, last_name, birthdate, email, mobile, parental_permission_file 
                  FROM `slf_appointments`
                  INNER JOIN slf_persons ON slf_appointments.person_id = slf_persons.person_id";

        if ($sort_by !== '' && $order !== '') {
            $query .= " ORDER BY $sort_by $order";
        } else {
            $query .= " ORDER BY hour ASC";
        }

        $database->query($query);
        $database->execute();
        return $database->get_records();
    }

    /**
     * @return array
     */
    public static function get_all_appointments_to_export() {
        $database = new Database();
        $query = "SELECT appointment_id, `hour`, participants, first_name, last_name, email, phone, mobile, birthdate, parental_permission_file
                  FROM `slf_appointments`
                  INNER JOIN slf_persons ON slf_appointments.person_id = slf_persons.person_id
                  ORDER BY `hour` ASC";
        $database->query($query);
        $database->execute();
        return $database->get_records();
    }

    /**
     * @param $appointment_id
     * @return object Person
     */
    public static function get_person_by_appointment_id($appointment_id) {
        $appointment = new Appointment($appointment_id);
        return $appointment->get_person();
    }

    /**
     * @param $appointment_id
     * @return int person_id
     */
    public static function get_person_id_by_appointment_id($appointment_id) {
        $person = self::get_person_by_appointment_id($appointment_id);
        return $person->getPersonId();
    }

    /**
     * @param $appointment_id
     */
    public static function delete_appointment($appointment_id) {
        $database = new Database();
        $person_id = self::get_person_id_by_appointment_id($appointment_id);

        // Deleting a person
        $database->query("DELETE FROM slf_appointments WHERE appointment_id = '$appointment_id'");
        $database->execute();

        // Deleting an appointment
        $database->query("DELETE FROM slf_persons WHERE person_id = '$person_id'");
        $database->execute();
    }

    /**
     * Delete everything -> DANGEROUS
     */
    public static function delete_appointments() {
        $database = new Database();

        // Deleting persons
        $database->query("TRUNCATE TABLE slf_persons");
        $database->execute();

        // Deleting appointments
        $database->query("TRUNCATE TABLE slf_appointments");
        $database->execute();
    }
}