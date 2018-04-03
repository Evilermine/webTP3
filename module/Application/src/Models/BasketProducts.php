<?php

namespace Application\Models;

class BasketProducts{
    private $dateAdded;

    public function toValues(){
        return [
            'dateAdded' => $this->dateAdded
        ];
    }
}

?>