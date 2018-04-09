<?php

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Form\SigninForm;
use User\Form\SignupForm;
use User\Models\User;
use Zend\Authentication\Result;

class AuthController extends AbstractActionController
{
    private $_authManager;
    private $_userManager;

    public function __construct($authManager, $userManager){
        $this->_authManager = $authManager;
        $this->_userManager = $userManager;
    }


    public function loginAction(){
        $id = (string)$this->params()->fromRoute('username', -1);
        $form = new SigninForm();
        $user = new User();
        $isLoginError = false;


        if($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($data);
                $result = $this->_authManager->login($data['username'], $data['password']);

<<<<<<< HEAD
=======
            if($form->isValid()){
                $data = $form->getData();

                $result = $_authManager->login($data['username'], $data['password']);

>>>>>>> 78d9db7d3557b5cdcea80b087389211cc153a0d4
                if($result->getCode() == Result::SUCCESS){
                    return $this->redirect()->toRoute('catalogue');  
                }
                else{
                    $isLoginError = true;
                }
        }

        return new ViewModel([
            'form' => $form,
            'isLoginError' => $isLoginError,
            ]);
    }
    
    public function logoutAction()
    {

    }

    public function signupAction(){
        $id = $this->params()->fromRoute('username', -1);
        $user = new User();
        $form = new SignupForm();

        if($this->getRequest()->isPost()){
            $data = $this->params()->fromPost();

            $form->setData($data);


                $this->_userManager->insert($data);
                return $this->redirect()->toRoute('catalogue');
        }

        return new ViewModel(['form' => $form]);
    }
}