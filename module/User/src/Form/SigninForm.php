<?php
namespace User\Form;

// Define an alias for the class name
use Zend\Form\Form;
use Zend\Form\Fieldset;

// A feedback form model
class SigninForm extends Form
{
  // Constructor.   
  public function __construct()
  {
    // Define form name
    parent::__construct('login-form');

    // Set POST method for this form
    $this->setAttribute('method', 'post');

    // (Optionally) set action for this form
    $this->setAttribute('action', '/login');
    $this->addElements();
    
    // Ajouter des filtres pour valider la longueur du mdp et de la longueur de l'URL
  }

  protected function addElements()
  {
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
            'type' => 'submit',
            'name' => 'submit',
            'attributes' => [
                'value' => 'Sign in',
                'id' => 'submit',
                'class' => 'btn btn-primary',
            ],
        ]);

    //???
    $this->add([            
        'type'  => 'hidden',
        'name' => 'redirect_url'
    ]);

    /*
        Securite contre les connections fais par des scripts malveillants
    */
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