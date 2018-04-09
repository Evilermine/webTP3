<?php

use Zend\Session\Storage\SessionArrayStorage;
use Zend\Session\Validator\RemoteAddr;
use Zend\Session\Validator\HttpUserAgent;

return [
    'db' => [
        'driver' => 'Pdo',
        'dsn' => 'mysql:dbname=onlineCatalogue;host=127.0.0.1;charset=utf8',
        'username' => 'root',
        'password' => '',
    ],
    'session_config' => [
        'cookie_lifetime'     => 60*60*1,
        'gc_maxlifetime'      => 60*60*24*30,    
    ],
    'session_manager' => [
        'validators' => [
            RemoteAddr::class,
            HttpUserAgent::class,
        ]
    ],
    'session_storage' => [
        'type' => SessionArrayStorage::class
    ],
    'service_manager' => [
        'factories' => [
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ],
    ],
];

?>