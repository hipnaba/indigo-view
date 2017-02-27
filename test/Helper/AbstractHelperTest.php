<?php
namespace IndigoTest\View\Helper;

use IndigoTest\View\Mock\ConcreteHelper;
use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\View\Helper\HeadLink;
use Zend\View\Renderer\JsonRenderer;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Renderer\RendererInterface;

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

        $result = $helper->protectedGetHelperPlugin($plugin);

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
        $helper->protectedGetHelperPlugin([]);
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

        $helper->protectedGetHelperPlugin('some');
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

        $headLink = $helper->protectedGetHelperPlugin('headLink');

        $this->assertInstanceOf(HeadLink::class, $headLink);
    }

    /**
     * GetHelperPlugin should pass options to helpers.
     *
     * @return void
     */
    public function testGetHelperWillPassOptionsToHelperPlugins()
    {
        $renderer = new PhpRenderer();
        $helperManager = $renderer->getHelperPluginManager();
        $helperManager->setFactory(ConcreteHelper::class, InvokableFactory::class);

        $helper = new ConcreteHelper();
        $helper->setView($renderer);

        $options = ['param' => 'value'];
        $other = $helper->protectedGetHelperPlugin(ConcreteHelper::class, $options);

        $this->assertEmpty($helper->getOptions());
        $this->assertEquals($options, $other->getOptions());
    }

    /**
     * Helpers will always have a renderer instance.
     *
     * @return void
     */
    public function testHelpersHaveDefaultRenderer()
    {
        $helper = new ConcreteHelper();
        $renderer = $helper->getView();

        $this->assertNotNull($renderer);
        $this->assertInstanceOf(RendererInterface::class, $renderer);
    }
}
