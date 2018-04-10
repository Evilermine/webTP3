<?php

namespace Application\Services;

use Zend\Db\TableGateway\TableGatewayInterface;
use Application\Models\Product;
use Application\Models\Basket;

class BasketTable{
    protected $_tableGateway;

    public function __construct(TableGatewayInterface $tableGateway){
        $this->_tableGateway = $tableGateway;
    }

    public function fetchAll() {
        $resultSet = $this->_tableGateway->select();
        $return = array();

        foreach($resultSet as $r) {$return[]=$r;}
        
        return $return;
    }

    public function pushProduct($product) {

    }

    public function insert($data){
        $insert  = [
            'basketId' => $data['basketId'],
            'basketTotal' => $data['basketTotal'],
            'item' => $data['productId'],
        ];
        $this->_tableGateway->insert($insert);
    }   

    public function update($data){
        $total = $this->_tableGateway->select(['total' => $basketId]);

        $update = [
            'total' => 'total' + $data['productPrice'],
        ];
    }

    public function find($id){
        return $this->_tableGateway->select(['basketId' => $id])->current();
    }
}
?>