<?php
namespace Indigo\View\Helper;

use Indigo\View\Exception;
use Indigo\View\HelperPluginAwareInterface;
use Indigo\View\ObjectProxyInterface;

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

        if ($object instanceof ObjectProxyInterface) {
            // Allow proxies to overrid the view helper of the object.
            if ($object instanceof HelperPluginAwareInterface) {
                $plugin = $this->getHelperPlugin($object->getHelperPlugin());
            }

            $object = $object->getProxiedObject();
        }

        if (!is_callable($plugin) && $object instanceof HelperPluginAwareInterface) {
            $plugin = $this->getHelperPlugin($object->getHelperPlugin());
        }

        if (!is_callable($plugin) &&  method_exists($object, '__toString')) {
            $plugin = [$object, '__toString'];
        }

        return is_callable($plugin)
            ? $plugin($object)
            : get_class($object);
    }
}
