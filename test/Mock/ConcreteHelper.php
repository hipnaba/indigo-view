<?php
namespace IndigoTest\View\Mock;

use Indigo\View\Helper\AbstractHelper;

/**
 * Class ConcreteHelper
 *
 * @package IndigoTest\View\Mock
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-view
 */
class ConcreteHelper extends AbstractHelper
{
    /**
     * Method under test.
     *
     * @param string $plugin Helper plugin.
     *
     * @return callable
     */
    public function getHelperPlugin($plugin)
    {
        return parent::getHelperPlugin($plugin);
    }
}
