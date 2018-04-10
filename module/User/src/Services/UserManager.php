<?php
namespace User\Services;

use Zend\Db\TableGateway\TableGatewayInterface;  
use Zend\Db\TableAbstract;

class UserManager{
    protected $_tableGateway;

    public function __construct(TableGatewayInterface $tableGateway){
        $this->_tableGateway = $tableGateway;
    }

    public function findByUsername($username){
        return $this->_tableGateway->select(['username' => $username])->current();
    }

    public function insert($data){
        $salt = $this->generateSalt();
        $password = hash('sha512', $salt . $data['password']);
        $base64pass = base64_encode($password);
        var_dump($base64pass);
        
        $insert = [
            'username' => $data['username'],
            'salt' => $salt,
            'password' => $base64pass,
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'address' => $data['address'],
            'city' => $data['city'],
            'country' => $data['country'],
        ];  

        $this->_tableGateway->insert($insert);
    }

    private function generateSalt(){
        $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/\\][{}\'";:?.>,<!@#$%^&*()-_=+|';
        $saltLen = 64;
           
        $salt = "";
        for ($i = 0; $i < $saltLen; $i++) {
            $salt .= $charset[mt_rand(0, strlen($charset) - 1)];
        }
        
        return $salt;
    }
}
?>