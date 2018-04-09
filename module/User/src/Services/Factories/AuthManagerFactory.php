<?php
namespace User\Services\Factories;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Session\SessionManager;
use User\Services\AuthManager;

class AuthManagerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {

        $authenticationService = $container->get(AuthenticationService::class);
        $sessionManager = $container->get(SessionManager::class);
        
        return new AuthManager($authenticationService, $sessionManager);
    }
}
