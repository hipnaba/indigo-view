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
     * Helper options-
     */
    protected $options;

    /**
     * ConcreteHelper constructor.
     *
     * @param array $options Helper options
     */
    public function __construct(array $options = null)
    {
        $this->options = $options ?: [];
    }

    /**
     * Returns the helper options.
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Method under test.
     *
     * @param string     $plugin  Helper plugin.
     * @param array|null $options Helper options.
     *
     * @return callable|object
     *
     * @noinspection PhpSignatureMismatchDuringInheritanceInspection
     */
    public function protectedGetHelperPlugin($plugin, array $options = null)
    {
        return parent::getHelperPlugin($plugin, $options);
    }
}
