<?php

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Form\SigninForm;
use User\Models\User;
use Zend\Authentication\Result;

class AuthController extends AbstractActionController
{
    private $_authManager;
    private $_userManager;

    public function __construct($authManager, $userManager){
        $_authManager = $authManager;
        $_userManager = $userManager;
    }


    public function loginAction(){
        $id = (string)$this->params()->fromRoute('username', -1);
        $form = new SigninForm();
        $user = new User();
        $isLoginError = false;


        if($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($data);

            if($form->isValid()){
                $data = $form->getData();

                $result = $_authManager->login($data['username'], $data['password']);

<<<<<<< HEAD
        return new ViewModel(['form' => $form]);
=======
                if($result->getCode() == Result::SUCCESS){
                    return $this->redirect()->toRoute('catalogue');  
                }
                else{
                    $isLoginError = true;
                }
            }
            else{
                $isLoginError = true;
            }
        }

        return new ViewModel([
            'form' => $form,
            'isLoginError' => $isLoginError,
            ]);
>>>>>>> ba6f98aa61a38cba2564029f5a2ad4d68136979a
    }
    
    public function logoutAction()
    {

    }
}