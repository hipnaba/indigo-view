<?php
namespace IndigoTest\View\Helper;

use Indigo\View\Helper\AbstractHelper;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject as MockObject;
use Zend\View\Helper\HeadLink;
use Zend\View\Renderer\JsonRenderer;
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
     * Calls a protected object method.
     *
     * @param object $object The object.
     * @param string $method The method name.
     * @param array  $args   The method arguments.
     *
     * @return mixed
     */
    protected function callProtectedMethod($object, $method, array $args = [])
    {
        $class = new \ReflectionClass($object);
        $method = $class->getMethod($method);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $args);
    }

    /**
     * Helpers will have a default pluggable renderer.
     *
     * @return void
     */
    public function testHelpersHaveDefaultRenderer()
    {
        /**
         * Helper under test.
         *
         * @var AbstractHelper|MockObject $helper
         */
        $helper = $this->getMockForAbstractClass(AbstractHelper::class);
        $renderer = $helper->getView();

        $this->assertNotNull($renderer);
        $this->assertInstanceOf(RendererInterface::class, $renderer);
        $this->assertTrue(method_exists($renderer, 'plugin'), 'The default renderer must be pluggable.');
    }

    /**
     * GetHelperPlugin should return the helper if it's already callable
     *
     * @return void
     */
    public function testGetHelperPluginWillReturnHelperIfAlreadyCallable()
    {
        /**
         * Helper under test.
         *
         * @var AbstractHelper|MockObject $helper
         */
        $helper = $this->getMockForAbstractClass(AbstractHelper::class);
        $plugin = function () {
        };

        $result = $this->callProtectedMethod($helper, 'getHelperPlugin', [$plugin]);

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
        /**
         * Helper under test.
         *
         * @var AbstractHelper|MockObject $helper
         */
        $helper = $this->getMockForAbstractClass(AbstractHelper::class);
        $plugin = [];

        $this->callProtectedMethod($helper, 'getHelperPlugin', [$plugin]);
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
        /**
         * Helper under test.
         *
         * @var AbstractHelper|MockObject $helper
         */
        $helper = $this->getMockForAbstractClass(AbstractHelper::class);
        $helper->setView(new JsonRenderer());

        $this->callProtectedMethod($helper, 'getHelperPlugin', ['name']);
    }

    /**
     * GetHelperPlugin will actually return helpers from the renderer.
     *
     * @return void
     */
    public function testGetHelperPluginWillReturnPlugins()
    {
        /**
         * Helper under test.
         *
         * @var AbstractHelper|MockObject $helper
         */
        $helper = $this->getMockForAbstractClass(AbstractHelper::class);

        $headLink = $this->callProtectedMethod($helper, 'getHelperPlugin', ['headLink']);

        $this->assertInstanceOf(HeadLink::class, $headLink);
    }
}
