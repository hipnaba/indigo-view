<?php
/**
 * Module configuration.
 *
 * @package Indigo\View
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-view
 */
return [
    'view_helpers' => [
        'aliases' => [
            'indent'       => \Indigo\View\Helper\Indent::class,
            'Indent'       => \Indigo\View\Helper\Indent::class,
            'renderobject' => \Indigo\View\Helper\RenderObject::class,
            'renderObject' => \Indigo\View\Helper\RenderObject::class,
            'RenderObject' => \Indigo\View\Helper\RenderObject::class,
        ],
        'factories' => [
            \Indigo\View\Helper\Indent::class       => \Zend\ServiceManager\Factory\InvokableFactory::class,
            \Indigo\View\Helper\RenderObject::class => \Zend\ServiceManager\Factory\InvokableFactory::class,
        ],
    ],
];
