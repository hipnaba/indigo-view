<?php
namespace Indigo\View;

/**
 * Objects implementing this interface can be rendered by a view helper.
 *
 * @package Indigo\View
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-view
 */
interface RenderableInterface
{
    /**
     * Returns the helper plugin used to render this object.
     *
     * The return value can be the actual plugin or a name to be used
     * to retreive the plugin from the plugin manager.
     *
     * @return mixed
     */
    public function getHelperPlugin();
}
