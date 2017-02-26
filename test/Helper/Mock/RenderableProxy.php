<?php
namespace IndigoTest\View\Helper\Mock;

use Indigo\View\RenderableProxyInterface;

/**
 * Class RenderableProxy
 *
 * @package IndigoTest\View\Helper\Mock
 * @author  Danijel Fabijan <danijel.fabijan@bruckom.hr>
 * @link    https://github.com/hipnaba/indigo-view
 */
class RenderableProxy implements RenderableProxyInterface
{
    protected $object;

    protected $helper;

    /**
     * RenderableProxy constructor.
     *
     * @param mixed $object Object to render.
     * @param mixed $helper Helper to use.
     */
    public function __construct($object, $helper)
    {
        $this->object = $object;
        $this->helper = $helper;
    }

    /**
     * Returns the helper plugin used to render this object.
     *
     * The return value can be the actual plugin or a name to be used
     * to retreive the plugin from the plugin manager.
     *
     * @return mixed
     */
    public function getHelperPlugin()
    {
        return $this->helper;
    }

    /**
     * Returns the object for rendering.
     *
     * @return mixed
     */
    public function getObjectToRender()
    {
        return $this->object;
    }
}
