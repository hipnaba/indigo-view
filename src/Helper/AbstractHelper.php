<?php
namespace Indigo\View\Helper;

use Zend\View\Helper\AbstractHelper as BaseAbstractHelper;
use Zend\View\Renderer\RendererInterface;

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
     * Fetches a helper plugin from the renderer.
     *
     * @param string     $plugin  The plugin's name.
     * @param array|null $options Plugin options.
     *
     * @return callable
     */
    protected function getHelperPlugin($plugin, array $options = null)
    {
        if (is_callable($plugin)) {
            return $plugin;
        }

        if (!is_string($plugin)) {
            throw new \InvalidArgumentException(sprintf(
                "Plugin name must be a string, %s provided",
                is_object($plugin) ? get_class($plugin) : gettype($plugin)
            ));
        }

        $renderer = $this->getView();

        if (!$renderer instanceof RendererInterface) {
            throw new \RuntimeException('Renderer not set.');
        }

        if (!method_exists($renderer, 'plugin')) {
            throw new \RuntimeException(sprintf(
                "The renderer '%s' isn't pluggable.",
                get_class($renderer)
            ));
        }

        return $renderer->plugin($plugin, $options);
    }
}
