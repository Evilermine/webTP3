<?php

namespace Application\Services;

use Zend\Db\TableGateway\TableGatewayInterface;
use Application\Models\Product;

class CatalogueTable{
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

    public function insert($data){



        $insert  =[
            'productName' => $data['productName'],
            'productPrice' => $data['productPrice'],
            'productDesc' => $data['productDesc'],
            'imageURL' => $data['imageURL'],
        ];

        $this->_tableGateway->insert($insert);
    }

    public function find($id){
        return $this->_tableGateway->select(['productId' => $id])->current();
    }
}
?>