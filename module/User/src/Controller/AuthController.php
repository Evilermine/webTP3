<?php

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Form\SigninForm;

class AuthController extends AbstractActionController
{
    public function loginAction()
    {
        $form = new SigninForm();

        return new ViewModel(['form' => $form]);
    }
    
    public function logoutAction()
    {

    }
}