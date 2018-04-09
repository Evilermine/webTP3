<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Db;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\AdapterInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'catalogue',
                    ],
                ],
            ],
            'application' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/application[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'catalogue'   => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/catalogue',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'catalogue',
                    ],
                ],
            ],
            'addProduct'    => [
                'type'      => Segment::class,
                'options'   => [
                    'route'     => '/addProduct[/:id]',
                    'defaults'  => [
                        'controller'    => Controller\IndexController::class,
                        'action'        => 'addProduct',
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'factories' => [
            Services\CatalogueTableGateway::class => Services\Factories\CatalogueTableGatewayFactory::class,
            Services\CatalogueTable::class => Services\Factories\CatalogueTableFactory::class,
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => Controller\Factories\IndexControllerFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view/',
        ],
    ],
    
    'access_filter' => [
        'options' => [
            // The access filter can work in 'restrictive' (recommended) or 'permissive'
            // mode. In restrictive mode all controller actions must be explicitly listed 
            // under the 'access_filter' config key, and access is denied to any not listed 
            // action for users not logged in. In permissive mode, if an action is not listed 
            // under the 'access_filter' key, access to it is permitted to anyone (even for 
            // users not logged in. Restrictive mode is more secure and recommended.
            'mode' => 'restrictive'
        ],
        'controllers' => [
            Controller\IndexController::class => [
                // Allow anyone to visit "index" and "about" actions
                ['actions' => ['index', 'catalogue'], 'allow' => '*'],
                // Allow authenticated users to visit "settings" action
                ['actions' => ['addProduct'], 'allow' => '@']
            ],
        ]
    ],
];
