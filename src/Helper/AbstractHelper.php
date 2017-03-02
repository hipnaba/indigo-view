<?php
namespace Indigo\View\Helper;

use Zend\View\Helper\AbstractHelper as BaseAbstractHelper;

/**
 * Base helper plugin class.
 *
 * @package Indigo\View\Helper
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-view
 */
abstract class AbstractHelper extends BaseAbstractHelper
{
    /**
     * Indent view helper.
     *
     * @var Indent
     */
    protected $indent;

    /**
     * RenderObject view helper.
     *
     * @var RenderObject
     */
    protected $renderObject;

    /**
     * Returns the Indent view helper.
     *
     * @return Indent
     */
    protected function getIndentHelper()
    {
        if (null === $this->indent) {
            if (method_exists($this->view, 'plugin')) {
                $this->indent = $this->view->plugin('indent');
            } else {
                $this->indent = new Indent();
            }
        }
        return $this->indent;
    }

    /**
     * Returns the RenderObject helper.
     *
     * @return RenderObject
     */
    protected function getRenderObjectHelper()
    {
        if (null === $this->renderObject) {
            if (method_exists($this->view, 'plugin')) {
                $this->renderObject = $this->view->plugin('renderObject');
            } else {
                $this->renderObject = new RenderObject();
            }
        }
        return $this->renderObject;
    }
}
