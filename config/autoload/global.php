<?php

return [
    'db' => [
        'driver' => 'Pdo',
        'dsn' => 'mysql:dbname=onlineCatalogue;host=localhost;charset=utf8',
    ],
    
    'service_manager' => [
        'factories' => [
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ],
    ],
];

?>