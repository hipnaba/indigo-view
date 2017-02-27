<?php
namespace IndigoTest\View\Helper;

use IndigoTest\View\Mock\ConcreteHelper;
use PHPUnit\Framework\TestCase;
use Zend\View\Helper\HeadLink;
use Zend\View\Renderer\JsonRenderer;
use Zend\View\Renderer\PhpRenderer;

/**
 * AbstractHelper tests.
 *
 * @package IndigoTest\View\Helper
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-view
 */
class AbstractHelperTest extends TestCase
{
    /**
     * GetHelperPlugin should return the helper if it's already callable
     *
     * @return void
     */
    public function testGetHelperPluginWillReturnHelperIfAlreadyCallable()
    {
        $helper = new ConcreteHelper();

        $plugin = function () {
        };

        $result = $helper->getHelperPlugin($plugin);

        $this->assertSame($plugin, $result);
    }

    /**
     * Other than callables getHelperPlugin will accept only strings.
     *
     * @return void
     *
     * @expectedException \InvalidArgumentException
     */
    public function testGetHelperPluginWillThrowExceptionForInvalidPluginName()
    {
        $helper = new ConcreteHelper();
        $helper->getHelperPlugin([]);
    }

    /**
     * GetHelperPlugin will throw an exception if the renderer is not set.
     *
     * @return void
     *
     * @expectedException \RuntimeException
     */
    public function testGetHelperPluginWillThrowExceptionIfRendererNotSet()
    {
        $helper = new ConcreteHelper();
        $helper->getHelperPlugin('some');
    }

    /**
     * GetHelperPlugin will throw an exception if the renderer is not pluggable.
     *
     * @return void
     *
     * @expectedException \RuntimeException
     */
    public function testGetHelperPluginWillThrowExceptionIfRendererNotPluggable()
    {
        $helper = new ConcreteHelper();
        $helper->setView(new JsonRenderer());

        $helper->getHelperPlugin('some');
    }

    /**
     * GetHelperPlugin will actually return helpers from the renderer.
     *
     * @return void
     */
    public function testGetHelperPluginWillReturnPlugins()
    {
        $helper = new ConcreteHelper();
        $helper->setView(new PhpRenderer());

        $headLink = $helper->getHelperPlugin('headLink');

        $this->assertInstanceOf(HeadLink::class, $headLink);
    }
}
