<?php

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Form\SigninForm;

class AuthController extends AbstractActionController
{
    public function loginAction()
    {
        return new ViewModel([
            'form' => new SigninForm()
        ]);
    }
    
    public function logoutAction()
    {

    }
}