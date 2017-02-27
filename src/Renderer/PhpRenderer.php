<?php
namespace Indigo\View\Renderer;

use Indigo\View\ConfigProvider;
use Indigo\View\RenderableInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\View\HelperPluginManager;
use Zend\View\Model\ModelInterface;
use Zend\View\Renderer\PhpRenderer as BasePhpRenderer;
use Zend\View\Renderer\RendererInterface;

/**
 * An extension to Zend's PhpRenderer.
 *
 * The render method is updated to accept objects implementing
 * \Indigo\View\RenderableInterface. It uses the Renderable helper
 * plugin internally.
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
        return $this->__helpers;
    }

    /**
     * {@inheritdoc}
     *
     * @param string|HelperPluginManager $helpers The new plugin manager.
     *
     * @return void
     */
    public function setHelperPluginManager($helpers)
    {
        parent::setHelperPluginManager($helpers);
        $this->__helpers = $helpers;
    }

    /**
     * {@inheritdoc}
     *
     * @param string|ModelInterface|RendererInterface $nameOrModel Rendering target.
     * @param array|null                              $values      Values to be used for rendering
     *                                                             or helper options for RenderableInterface.
     *
     * @return string
     */
    public function render($nameOrModel, $values = null)
    {
        if ($nameOrModel instanceof RenderableInterface) {
            /**
             * The helper plugin used for rendering.
             *
             * @var callable $renderableHelper
             */
            $renderableHelper = $this->plugin('renderable', $values ?: []);
            return $renderableHelper($nameOrModel);
        }

        return parent::render($nameOrModel, $values);
    }
}
