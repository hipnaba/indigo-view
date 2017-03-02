<?php
namespace Indigo\View\Helper;

use Indigo\View\Exception;
use Indigo\View\HelperPluginAwareInterface;

/**
 * Tries to render an object.
 *
 * This plugin actually proxies the rendering to the plugin defined
 * by the object itself.
 *
 * @package Indigo\View\Helper
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-view
 */
class RenderObject extends AbstractHelper
{
    /**
     * Returns the helper or proxies to render().
     *
     * @param object $object Object to render.
     *
     * @return string
     */
    public function __invoke($object = null)
    {
        if (null === $object) {
            return $this;
        }

        return $this->render($object);
    }

    /**
     * Tries to render an object.
     *
     * @param object $object Object to render.
     *
     * @return string
     */
    public function render($object)
    {
        if (!is_object($object)) {
            throw new Exception\InvalidArgumentException(sprintf(
                '$object must be an object, %s received',
                gettype($object)
            ));
        }

        $plugin = false;

        if ($object instanceof HelperPluginAwareInterface) {
            $pluginName = $object->getHelperPlugin();

            if ('renderObject' !== $pluginName) {
                if (!$this->view) {
                    throw new \RuntimeException("Renderer not set. Can't fetch helper plugins.");
                }

                if (!method_exists($this->view, 'plugin')) {
                    throw new \RuntimeException('The renderer is not pluggable.');
                }

                $plugin = $this->view->plugin($pluginName);
            }
        }

        if (!is_callable($plugin) &&  method_exists($object, '__toString')) {
            $plugin = [$object, '__toString'];
        }

        return is_callable($plugin)
            ? $plugin($object)
            : get_class($object);
    }
}
