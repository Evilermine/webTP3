<?php

namespace Application\Models;

class Basket{

    private $basketId;
    private $basketTotal;
    private $item;


    public function exchangeArray($data){
        $this->basketId = (!empty($data['basketId'])) ? $data['basketId'] : null;
        $this->basketTotal = (!empty($data['basketTotal'])) ? $data['basketTotal'] : null;
        $this->item = (!empty($data['item'])) ? $data['item'] : null;
    }

    public function toValues(){
        return[
            'basketId' => $this->basketId,
            'basketTotal' => $this->basketTotal,
            'item' => $this->item
        ];
    }
}

?>