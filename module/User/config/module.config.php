<?php

namespace User;

use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

return [
    'controllers' => [
        'factories' => [
            Controller\AuthController::class => Controller\Factories\AuthControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            Services\AuthManager::class => Services\Factories\AuthManagerFactory::class,
            Services\UserManager::class => Services\Factories\UserManagerFactory::class,
            Services\AuthAdapter::class => Services\Factories\AuthAdapterFactory::class,
            Services\UserGateway::class => Services\Factories\UserGatewayFactory::class,
            \Zend\Authentication\AuthenticationService::class => Services\Factories\AuthenticationServiceFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'login' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/login[/:id]',
                    'defaults' => [
                        'controller' => Controller\AuthController::class,
                        'action' => 'login',
                    ],
                ],
            ],
            'logout' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/logout',
                    'defaults' => [
                        'controller' => Controller\AuthController::class,
                        'action' => 'logout',
                    ],
                ],
            ],
            'signup' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/signup',
                    'defaults' => [
                        'controller' => Controller\AuthController::class,
                        'action' => 'signup',
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'user' => __DIR__ . '/../view',
        ],
    ],
    'access_filter' => [
        'options' => [
            'mode' => 'restrictive',
        ],
        'controllers' => [
            Controller\AuthController::class => [
                ['actions' => ['login'], 'allow' => '*'],
                ['actions' => ['signup'], 'allow' => '@'],
            ]
        ]
    ]
];