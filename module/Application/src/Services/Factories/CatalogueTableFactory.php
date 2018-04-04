<?php

namespace Application\Services\Factories;

use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Session\SessionManager;
use Zend\Authentication\Storage\Session as SessionStorage;
use Interop\Container\ContainerInterface;
use Application\Services\CatalogueTableGateway;
use Application\Services\CatalogueTable;

class CatalogueTableFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null){
        $tableGateway = $container->get(CatalogueTableGateway::class);
        $table = new CatalogueTable($tableGateway);
        return $table;
    }
}
?>