<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Dip\Controller\Dip' => 'Dip\Controller\DipController',
            'people' => 'Dip\Controller\PeopleController',
        ),
    ),


    // add this section
    'router' => array(
        'routes' => array(
            'dip' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/dip',
                    'constraints' => array(
                        'action' => '[a-zA-Z]',
                    ),
                    'defaults' => array(
                        'controller' => 'Dip\Controller\Dip',
                        'action' => 'index',
                    ),
                ),
            ),

            'people' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/people',
                    'constraints' => array(
                        'action' => '[a-zA-Z]',
                    ),
                    'defaults' => array(
                        'controller' => 'people',
                        'action' => 'index',
                    ),
                ),
            ),

            'search' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/search',
                    'defaults' => array(
                        'controller' => 'people',
                        'action'     => 'search',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'dip' =>  __DIR__ . '/../view',
        ),
    ),




);