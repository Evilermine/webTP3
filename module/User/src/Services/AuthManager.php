<?php
namespace User\Services;

use Zend\Authentication\Result;
use Zend\Authentication\AuthenticationService;
use Zend\Session\SessionManager;


class AuthManager
{
    private $authService;
    
    private $sessionManager;

    public function __construct(AuthenticationService $authService, SessionManager $sessionManager) 
    {
        $this->authService = $authService;
        $this->sessionManager = $sessionManager;
    }
    
    public function login($username, $password)
    {   
        if ($this->authService->getIdentity()!=null) {
            throw new \Exception('Already logged in');
        }
        
        $authAdapter = $this->authService->getAdapter();
        $authAdapter->_username = $username;
        $authAdapter->_password = $password;
        $result = $this->authService->authenticate();

        if ($result->getCode()==Result::SUCCESS) {
            $this->sessionManager->rememberMe(60*60*24*30); // 30 jours
        }
        
        return $result;
    }
    
    public function logout()
    {
        if ($this->authService->getIdentity()==null) {
            throw new \Exception('The user is not logged in');
        }
        
        $this->authService->clearIdentity();               
    }

    public function isLogged() {
        return $this->authService->hasIdentity();
    }
}