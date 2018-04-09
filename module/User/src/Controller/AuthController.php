<?php

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Form\SigninForm;
use User\Form\SignupForm;
use User\Models\User;
use User\Services\AuthManager;
use User\Services\UserManager;
use Zend\Authentication\Result;
use Zend\Permission\Rbac\Rbac;

class AuthController extends AbstractActionController
{
    private $_authManager;
    private $_userManager;
    private $_rbac;

    public function __construct($authManager, $userManager){
        $this->_authManager = $authManager;
        $this->_userManager = $userManager;
        $this->_rbac = new Rbac();
        $this->addRoles();
    }

    private function addRoles()
    {
        $this->_rbac->setCreateMissingRoles(true);

        $this->$_rbac->addRole('Guest', ['LoggedUser']);
        $this->$_rbac->addRole('LoggedUser', ['Administrator']);
        $this->$_rbac->addRole('Administrator');

        $this->$_rbac->getRole('Guest')->addPermission('read');
        $this->$_rbac->getRole('LoggedUser')->addPermission('add-to-basket');
        $this->$_rbac->getRole('Administrator')->addPermission('write');
    }

    public function hasPermission($role, $permission) {
        return $this->$_rbac->isGranted($role, $permission);
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

            if($form->isValid()){
                $data = $form->getData();

                $result = $_authManager->login($data['username'], $data['password']);

                if($result->getCode() == Result::SUCCESS){
                    return $this->redirect()->toRoute('catalogue');  
                }
                else{
                    $isLoginError = true;
                }
            }
        }

        return new ViewModel([
            'form' => $form,
            'isLoginError' => $isLoginError,
            ]);
    }
    
    public function logoutAction()
    {
        if($this->_authManager->isLogged())
            $this->_authManager->logout();

        return $this->redirect()->toRoute('catalogue');
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