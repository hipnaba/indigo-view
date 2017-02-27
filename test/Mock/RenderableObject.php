<?php
namespace IndigoTest\View\Mock;

use Indigo\View\RenderableInterface;

/**
 * Renderable mock implementation.
 *
 * @package IndigoTest\View\Helper\Mock
 * @author  Danijel Fabijan <danijel.fabijan@bruckom.hr>
 * @link    https://github.com/hipnaba/indigo-view
 */
class RenderableObject implements RenderableInterface
{
    /**
     * The helper plugin name.
     *
     * @var mixed
     */
    protected $helper;

    /**
     * RenderableObject constructor.
     *
     * @param mixed $helper The helper plugin used to render this object.
     */
    public function __construct($helper = null)
    {
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
        if (null === $this->helper) {
            $this->helper = function ($object) {
                return get_class($object);
            };
        }
        return $this->helper;
    }
}
