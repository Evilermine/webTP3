<?php

namespace Application\Services\Factories;

use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Session\SessionManager;
use Zend\Authentication\Storage\Session as SessionStorage;
use Interop\Container\ContainerInterface;
use Application\Services\BasketTableGateway;
use Application\Services\BasketTable;

class BasketTableFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null){
        $tableGateway = $container->get(BasketTableGateway::class);
        $table = new BasketTable($tableGateway);
        return $table;
    }
}
?>