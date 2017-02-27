<?php
namespace Indigo\View\Helper;

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
        $plugin = $this->getHelperPlugin($object->getHelperPlugin());

        if ($object instanceof RenderableProxyInterface) {
            $object = $object->getObjectToRender();
        }

        return $plugin($object);
    }
}
