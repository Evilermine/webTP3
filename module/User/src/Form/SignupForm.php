<?php
namespace User\Form;

// Define an alias for the class name
use Zend\Form\Form;
use Zend\Form\Fieldset;

// A feedback form model
class SignupForm extends Form
{
  // Constructor.   
  public function __construct()
  {
    // Define form name
    parent::__construct('signup-form');

    // Set POST method for this form
    $this->setAttribute('method', 'post');

    // (Optionally) set action for this form
    $this->setAttribute('action', '/signup');
    $this->addElements();
    
    // Ajouter des filtres pour valider la longueur du mdp et de la longueur de l'URL
  }

  protected function addElements()
  {
    /* Prenom */
    $this->add([
        'type'  => 'text',
        'name' => 'firstname',
        'attributes' => [                
            'id' => 'inputFirstname',
            'class' => 'form-control'
        ],
        'options' => [           
            'label' => 'prénom',  
         ],
    ]);

    
    $this->add([
        'type'  => 'text',
        'name' => 'lastname',
        'attributes' => [                
            'id' => 'inputLastname',
            'class' => 'form-control'
        ],
        'options' => [           
            'label' => 'Nom',  
         ],
    ]);

    $this->add([
        'type'  => 'email',
        'name' => 'email',
        'attributes' => [                
            'id' => 'inputEmail',
            'class' => 'form-control'
        ],
        'options' => [           
            'label' => 'Adresse courriel',  
         ],
    ]);

    $this->add([
        'type'  => 'text',
        'name' => 'address',
        'attributes' => [                
            'id' => 'inputAddress',
            'class' => 'form-control'
        ],
        'options' => [           
            'label' => 'Adresse',  
         ],
    ]);

    $this->add([
        'type'  => 'text',
        'name' => 'city',
        'attributes' => [                
            'id' => 'inputCity',
            'class' => 'form-control'
        ],
        'options' => [           
            'label' => 'Ville',  
         ],
    ]);

    $this->add([
        'type'  => 'text',
        'name' => 'country',
        'attributes' => [                
            'id' => 'inputCountry',
            'class' => 'form-control'
        ],
        'options' => [           
            'label' => 'Pays',  
         ],
    ]);

      /*
        On ajoute l'element de username
      */
    $this->add([
        'type'  => 'text',
        'name' => 'username',
        'attributes' => [                
            'id' => 'inputUsername',
            'class' => 'form-control'
        ],
        'options' => [           
            'label' => 'Nom dutilisateur',  
         ],
    ]);

    /*
         Le mot de passe
    */
    $this->add([
        'type'  => 'password',
        'name' => 'password',
        'attributes' => [                
            'id' => 'inputPassword',
            'class' => 'form-control'
        ],
        'options' => [           
            'label' => 'Mot de passe',  
         ],
    ]);

    $this->add([
        'type'  => 'password',
        'name' => 'passwordConfirm',
        'attributes' => [                
            'id' => 'inputConfirm',
            'class' => 'form-control'
        ],
        'options' => [           
            'label' => 'Confirmer le mot de passe',  
         ],
    ]);

    $this->add([
            'type' => 'submit',
            'name' => 'submit',
            'attributes' => [
                'value' => 'Sign up',
                'id' => 'submit',
                'class' => 'btn btn-primary',
            ],
        ]);

    //???
    $this->add([            
        'type'  => 'hidden',
        'name' => 'redirect_url'
    ]);

    $this->add([
        'type' => 'csrf',
        'name' => 'csrf',
        'options' => [
            'csrf_options' => [
                'timeout' => 600,
            ],
        ],
    ]);
  }
}