<?php
namespace Application\Controller\Factories;

use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Session\SessionManager;
use Zend\Authentication\Storage\Session as SessionStorage;
use User\Service\AuthAdapter;
use Interop\Container\ContainerInterface;
use Application\Controller\IndexController;
use Application\Services\CatalogueTable;

/**
 * The factory responsible for creating of authentication service.
 */
class IndexControllerFactory implements FactoryInterface
{
    /**
     * This method creates the Zend\Authentication\AuthenticationService service 
     * and returns its instance. 
     */
    public function __invoke(ContainerInterface $container, 
                    $requestedName, array $options = null)
    {
        $_table = $container->get(CatalogueTable::class);
        $controller = new IndexController($_table);
        return $controller;
    }
}