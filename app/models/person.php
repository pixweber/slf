<?php
namespace App\Models;

use App\Core\Database;

class Person extends Database {
    
    private $person_id;
    private $first_name;
    private $last_name;
    private $sex;
    private $birthdate;
    private $birthdate_fr;
    private $address;
    private $address_plus;
    private $postcode;
    private $city;
    private $email;
    private $phone;
    private $mobile;
    private $created_at;
    private $updated_at;

    public function __construct($person_id) {

        parent::__construct();

        // Do nothing if persion_id is not provided
        if (!$person_id) return;

        $query = "SELECT * FROM slf_persons WHERE person_id = :person_id";

        $this->query($query);
        $this->bind(':person_id', $person_id);
        $result = $this->single();

        if ($result) { // At least one person found
            $this->person_id = $person_id;
            $this->first_name = $result['first_name'];
            $this->last_name = $result['last_name'];
            $this->sex = $result['sex'];
            $this->birthdate = $result['birthdate'];
            $this->birthdate_fr = \DateTime::createFromFormat('Y-m-d', $this->birthdate)->format('d-m-Y');
            $this->address = $result['address'];
            $this->address_plus = $result['address_plus'];
            $this->postcode = $result['postcode'];
            $this->city = $result['city'];
            $this->email = $result['email'];
            $this->phone = $result['phone'];
            $this->mobile = $result['mobile'];
            $this->created_at = $result['created_at'];
            $this->updated_at = $result['updated_at'];
        }
    }

    /**
     * @return mixed
     */
    public function getPersonId() {
        return $this->person_id;
    }

    /**
     * @param mixed $person_id
     */
    public function setPersonId($person_id) {
        $this->person_id = $person_id;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param mixed $first_name
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param mixed $last_name
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * @return mixed
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @param mixed $sex
     */
    public function setSex($sex)
    {
        $this->sex = $sex;
    }

    /**
     * @return mixed
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * @param mixed $birthdate
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }

    /**
     * @return mixed
     */
    public function getBirthdateFr() {
        return $this->birthdate_fr;
    }

    /**
     * @param mixed $birthdate_fr
     */
    public function setBirthdateFr($birthdate_fr) {
        $this->birthdate_fr = $birthdate_fr;
    }


    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getAddressPlus() {
        return $this->address_plus;
    }

    /**
     * @param mixed $address_plus
     */
    public function setAddressPlus($address_plus) {
        $this->address_plus = $address_plus;
    }

    /**
     * @return mixed
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * @param mixed $postcode
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @param mixed $mobile
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param mixed $updated_at
     */
    public function setUpdatedAt($updated_at) {
        $this->updated_at = $updated_at;
    }
}