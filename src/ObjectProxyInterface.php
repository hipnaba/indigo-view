<?php
namespace Indigo\View;

/**
 * Allows objects to render an object other than themselves.
 *
 * This can be used to attach view helpers to any object. Just wrap
 * the object in this interface and set the helper plugin.
 *
 * @package Indigo\View
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-view
 */
interface ObjectProxyInterface extends HelperPluginAwareInterface
{
    /**
     * Returns the object to render.
     *
     * @return mixed
     */
    public function getProxiedObject();
}
