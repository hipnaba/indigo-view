<?php
namespace Indigo\View;

/**
 * Allows objects to render an object other than themselves.
 *
 * @package Indigo\View
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-view
 */
interface RenderableProxyInterface extends RenderableInterface
{
    /**
     * Returns the object for rendering.
     *
     * @return mixed
     */
    public function getObjectToRender();
}
