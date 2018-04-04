<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilter;
use Application\Models\Product;

class ProductForm extends Form {

    private $_product;

    public function __construct(Product $product){
        $this->_product = $product;

        //form name
        parent::__construct('product-form');

        // POST method
        $this->setAttribute('method', 'post');
        $this->setFields();
    }

    protected function setFields(){
        $this->add([
            'type' => 'text',
            'name' => 'productName',
            'options' => [
                'label' => 'Name',
            ],
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'productPrice',
            'options' => [
                'label' => 'Price',
            ],
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'productDesc',
            'options' => [
                'label' => 'Description du produit (500 characteres max)',
            ],
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'imageURL',
            'options' => [
                'label' => 'image',
            ],
        ]);

        $this->add([
            'type' => 'submit',
            'name' => 'submit',
            'attributes' => [
                'value' => 'Enregistrer',
                'id' => 'submit',
            ],
        ]);
    }
}
