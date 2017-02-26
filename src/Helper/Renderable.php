<?php
namespace Indigo\View\Helper;

use Indigo\View\Exception;
use Indigo\View\RenderableInterface;
use Indigo\View\RenderableProxyInterface;

/**
 * Renders a renderable object.
 *
 * This plugin actually proxies the rendering to the plugin defined
 * by the object itself.
 *
 * @package Indigo\View\Helper
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-view
 */
class Renderable extends AbstractHelper
{
    /**
     * Renders the object
     *
     * @param RenderableInterface $object Object to render.
     *
     * @return Renderable|string
     */
    public function __invoke(RenderableInterface $object = null)
    {
        if (null === $object) {
            return $this;
        }

        return $this->render($object);
    }

    /**
     * Renders the object.
     *
     * @param RenderableInterface $object Object to render.
     *
     * @return string
     */
    public function render(RenderableInterface $object)
    {
        $helperPlugin = $this->getHelperPlugin($object);

        if ($object instanceof RenderableProxyInterface) {
            $object = $object->getObjectToRender();
        }

        return $helperPlugin($object);
    }

    /**
     * Returns the view helper plugin used to render the given object.
     *
     * @param RenderableInterface $object The object.
     *
     * @return callable
     */
    protected function getHelperPlugin(RenderableInterface $object)
    {
        $plugin = $object->getHelperPlugin();

        if (is_string($plugin)) {
            $plugin = $this->getView()->plugin($plugin);
        }

        if (!is_callable($plugin)) {
            throw new Exception\InvalidHelperPluginException(sprintf(
                "%s: Invalid helper plugin '%s'. It's not callable",
                __METHOD__,
                is_object($plugin) ? get_class($plugin) : gettype($plugin)
            ));
        }

        return $plugin;
    }
}
