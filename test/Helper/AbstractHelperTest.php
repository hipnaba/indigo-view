<?php
namespace IndigoTest\View\Helper;

use Indigo\View\Helper\AbstractHelper;
use Indigo\View\Helper\Indent;
use Indigo\View\Helper\RenderObject;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject as MockObject;
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
     * The helper should provide default helpers.
     *
     * @return void
     */
    public function testHelperProvidesDefaultHelpers()
    {
        $helper = $this->getMockForAbstractClass(AbstractHelper::class);

        $indent = $this->callProtectedMethod($helper, 'getIndentHelper');
        $this->assertInstanceOf(Indent::class, $indent);

        $renderObject = $this->callProtectedMethod($helper, 'getRenderObjectHelper');
        $this->assertInstanceOf(RenderObject::class, $renderObject);
    }

    /**
     * The helper should try to fetch the plugins from the renderer.
     *
     * @return void
     */
    public function testHelperWillFetchPluginsFromTheRenderer()
    {
        /**
         * Resolver.
         *
         * @var RendererInterface|MockObject $renderer
         */
        $renderer = $this->createMock(PhpRenderer::class);
        $renderer
            ->expects($this->exactly(2))
            ->method('plugin')
            ->withConsecutive(
                ['indent'],
                ['renderObject']
            );

        /**
         * Helper under test.
         *
         * @var AbstractHelper|MockObject $helper
         */
        $helper = $this->getMockForAbstractClass(AbstractHelper::class);
        $helper->setView($renderer);

        $this->callProtectedMethod($helper, 'getIndentHelper');
        $this->callProtectedMethod($helper, 'getRenderObjectHelper');
    }
}
