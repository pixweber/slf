<?php
namespace App\Models;

use App\Core\Database;

class Appointment extends Database {
    private $appointment_id;
    private $person_id;
    private $hour;
    private $participants;
    private $for_me;
    private $for_my_family_members;
    private $for_other_family_members;

    public function __construct($appointment_id) {

        // Do nothing if $appointment_id is not provided
        if (!$appointment_id) return;

        parent::__construct();

        $query = "SELECT * FROM appointments WHERE appointment_id = :appointment_id";
        $this->query($query);
        $this->bind(':appointment_id', $appointment_id);
        $result = $this->single();

        if ($result) {
            $this->appointment_id = $appointment_id;
            $this->person_id = $result['person_id'];
            $this->hour = $result['hour'];
            $this->participants = $result['participants'];
            $this->for_me = $result['for_me'];
            $this->for_my_family_members = $result['for_my_family_members'];
            $this->for_other_family_members = $result['for_other_family_members'];
        }
    }

    /**
     * @return mixed
     */
    public function getAppointmentId()
    {
        return $this->appointment_id;
    }

    /**
     * @param mixed $appointment_id
     */
    public function setAppointmentId($appointment_id)
    {
        $this->appointment_id = $appointment_id;
    }

    /**
     * @return mixed
     */
    public function getPersonId()
    {
        return $this->person_id;
    }

    /**
     * @param mixed $person_id
     */
    public function setPersonId($person_id)
    {
        $this->person_id = $person_id;
    }

    /**
     * @return mixed
     */
    public function getHour() {
        return $this->hour;
    }

    /**
     * @param mixed $hour
     */
    public function setHour($hour) {
        $this->hour = $hour;
    }

    /**
     * @return mixed
     */
    public function getParticipants() {
        return $this->participants;
    }

    /**
     * @param mixed $participants
     */
    public function setParticipants($participants) {
        $this->participants = $participants;
    }

    /**
     * @return mixed
     */
    public function getForMe() {
        return $this->for_me;
    }

    /**
     * @param mixed $for_me
     */
    public function setForMe($for_me) {
        $this->for_me = $for_me;
    }

    /**
     * @return mixed
     */
    public function getForMyFamilyMembers() {
        return $this->for_my_family_members;
    }

    /**
     * @param mixed $for_my_family_members
     */
    public function setForMyFamilyMembers($for_my_family_members) {
        $this->for_my_family_members = $for_my_family_members;
    }

    /**
     * @return mixed
     */
    public function getForOtherFamilyMembers() {
        return $this->for_other_family_members;
    }

    /**
     * @param mixed $for_other_family_members
     */
    public function setForOtherFamilyMembers($for_other_family_members) {
        $this->for_other_family_members = $for_other_family_members;
    }

    /**
     * @return array
     */
    public function get_registration_options() {
        $options = array();

        if ( $this->getForMe() == '1') {
            $options[] = 'Je m\'inscris';
        }

        if ( $this->getForMyFamilyMembers() == '1') {
            $options[] = 'J\'inscris les membres de ma famille';
        }

        if ( $this->getForOtherFamilyMembers() == '1') {
            $options[] = 'J\'inscris les membres d’une autre famille';
        }

        return $options;
    }

    /**
     * @return string
     */
    public function get_registration_options_html() {
        ob_start();
        ?>
            <ul id="registration-options-list">
                <?php foreach ($this->get_registration_options() as $option) : ?>
                <li><?php echo $option; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php
        return ob_get_clean();
    }

    /**
     * @return Person $person
     */
    public function get_person() {
        return new Person($this->person_id);
    }
}

