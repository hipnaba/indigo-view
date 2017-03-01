<?php
namespace Indigo\View;

use Zend\ServiceManager\Factory\InvokableFactory;

/**
 * Provides configuration for the module.
 *
 * @package Indigo\View
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-view
 */
class ConfigProvider
{
    /**
     * Returns the View Helper Manager configuration.
     *
     * @return array
     */
    public function getViewHelperConfig()
    {
        return [
            'aliases' => [
                'indent'       => Helper\Indent::class,
                'renderObject' => Helper\RenderObject::class,
            ],
            'factories' => [
                Helper\Indent::class       => InvokableFactory::class,
                Helper\RenderObject::class => InvokableFactory::class,
            ],
        ];
    }
}
