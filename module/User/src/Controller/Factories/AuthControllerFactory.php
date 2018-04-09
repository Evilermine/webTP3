<?php
namespace User\Controller\Factories;

use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Session\SessionManager;
use Zend\Authentication\Storage\Session as SessionStorage;
use Interop\Container\ContainerInterface;
use User\Controller\AuthController;
use User\Services\UserManager;
use User\Services\AuthManager;


/**
 * The factory responsible for creating of authentication service.
 */
class AuthControllerFactory implements FactoryInterface
{
    /**
     * This method creates the Zend\Authentication\AuthenticationService service 
     * and returns its instance. 
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null){
        $_authManager = $container->get(AuthManager::class);
        $_userManager = $container->get(UserManager::class);
        $controller = new AuthController($_authManager, $_userManager);
        return $controller;
    }
}