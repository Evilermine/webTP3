<?php

namespace Application\Form;

use Zend\File;
use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilter;
use Application\Models\Product;

class ProductForm extends Form {

    public function __construct($name = null, $options = []){
        //form name
        parent::__construct($name, $options);

        // POST method
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype', 'multipart/form-data');
        $this->setFields();
        //$this->addFilter();
    }

    protected function addFilter(){
        $inputFilter = new InputFilter();

        $inputFilter->add([
            'type'     => 'Zend\InputFilter\FileInput',
            'name'     => 'imageURL',
            'required' => true,   
            'validators' => [
                ['name'    => 'FileUploadFile'],
                [
                    'name'    => 'FileMimeType',                        
                    'options' => [                            
                        'mimeType'  => ['image/jpeg', 'image/png', 'image/jpg']
                    ]
                ],
                ['name'    => 'FileIsImage'],
                [
                    'name'    => 'FileImageSize',
                    'options' => [
                        'minWidth'  => 128,
                        'minHeight' => 128,
                        'maxWidth'  => 4096,
                        'maxHeight' => 4096
                    ]
                ],
            ],
            'filters'  => [                    
                [
                    'name' => 'FileRenameUpload',
                    'options' => [  
                        'target' => './data/upload',
                        'useUploadName' => true,
                        'useUploadExtension' => true,
                        'overwrite' => true,
                        'randomize' => true
                    ]
                ]
            ],   
        ]);
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
            'type' => 'File',
            'name' => 'imageURL',
            'attributes' => [
                'id' => 'imageURL'
            ],
            'options' => [
                'label' => 'Fichier image',
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
