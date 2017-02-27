<?php
namespace Indigo\View\Renderer;

use Indigo\View\ConfigProvider;
use Zend\ServiceManager\ServiceManager;
use Zend\View\HelperPluginManager;
use Zend\View\Renderer\PhpRenderer as BasePhpRenderer;

/**
 * An extension to Zend's PhpRenderer.
 *
 * @package Indigo\View\Renderer
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-view
 */
class PhpRenderer extends BasePhpRenderer
{
    // @codingStandardsIgnoreStart
    private $__helpers;
    // @codingStandardsIgnoreEnd

    /**
     * {@inheritdoc}
     *
     * @return \Zend\View\HelperPluginManager
     */
    public function getHelperPluginManager()
    {
        if (null === $this->__helpers) {
            $config = new ConfigProvider();
            $this->__helpers = new HelperPluginManager(new ServiceManager(), $config->getViewHelperConfig());

            $this->setHelperPluginManager($this->__helpers);
        }
        return parent::getHelperPluginManager();
    }
}
