<?php

namespace User\Models;

class User{
    public $_username;
    public $_salt;
    public $_hashedPass;

    public function __construct() 
    {

    }

    public function exchangeArray($data)
    {
        $this->_username = (!empty($data['username'])) ? $data['username'] : null;
        $this->_salt = (!empty($data['salt'])) ? $data['salt'] : null;
        $this->_hashedPass = (!empty($data['password'])) ? $data['password'] : null;
    }

    public function toValues(){
        return [
            'username' => $this->_username,
            'salt' => $this->_salt,
            'password' => $this->_hashedPass
        ];
    }
}

?>