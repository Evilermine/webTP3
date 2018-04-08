<?php

return [
    'db' => [
        'driver' => 'Pdo',
        'dsn' => 'mysql:dbname=onlineCatalogue;host=127.0.0.1;charset=utf8',
        'username' => 'root',
        'password' => '',
    ],
    
    'service_manager' => [
        'factories' => [
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ],
    ],
];

?>