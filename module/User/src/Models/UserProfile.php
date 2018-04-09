<?php

namespace User\Models;

class UserProfile{
    public $_username;
    public $_firstname;
    public $_lastname;
    public $_address;
    public $_email;
    public $_city;
    public $_country;

    public function __contruct()
    {

    }

    public function exchangeArray($data)
    {
        $this->_username = (!empty($data['username'])) ? $data['username'] : null;
        $this->_firstname = (!empty($data['firstname'])) ? $data['firstname'] : null;
        $this->_lastname = (!empty($data['lastname'])) ? $data['lastname'] : null;
        $this->_email = (!empty($data['email'])) ? $data['email'] : null;
        $this->_address = (!empty($data['address'])) ? $data['address'] : null;
        $this->_city = (!empty($data['city'])) ? $data['city'] : null;
        $this->_country = (!empty($data['country'])) ? $data['country'] : null;
    }

    public function toValues(){
        return [
            'username' => $this->_username,
            'firstname' => $this->_firstname,
            'lastname' => $this->_lastname,
            'address' => $this->_address,
            'city' => $this->_city,
            'country' => $this->_country
        ];
    }
}
?>