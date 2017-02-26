<?php
namespace IndigoTest\View\Helper;

use Indigo\View\Helper\Renderable;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject as MockObject;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Renderer\RendererInterface;

/**
 * Tests \Indigo\View\Helper\Renderable
 *
 * @package IndigoTest\View\Helper
 * @author  Danijel Fabijan <danijel.fabijan@bruckom.hr>
 * @link    https://github.com/hipnaba/indigo-view
 */
class RenderableTest extends TestCase
{
    /**
     * Invokable interface returns the correct values.
     *
     * @return void
     */
    public function testInvokableInterface()
    {
        $helper = new Renderable();
        $object = new Mock\RenderableObject();

        $this->assertSame($helper, $helper());
        $this->assertTrue(is_string($helper($object)));
    }

    /**
     * The helper will throw exceptions for invalid helper plugins.
     *
     * @expectedException \Indigo\View\Exception\InvalidHelperPluginException
     *
     * @return void
     */
    public function testThrowsExceptionsForInvalidHelperPlugins()
    {
        $helper = new Renderable();
        $object = new Mock\RenderableObject([]);

        $helper->render($object);
    }

    /**
     * The plugin should accept a string as the helper plugin and fetch it from the view.
     *
     * @return void
     */
    public function testAcceptsStringsAsHelperPlugins()
    {
        /**
         * The renderer used for testing.
         *
         * @var MockObject|RendererInterface $renderer
         */
        $renderer = $this->createMock(PhpRenderer::class);
        $renderer->method('plugin')
            ->willReturn(function () {
                return 'my-helper';
            });

        $helper = new Renderable();
        $helper->setView($renderer);

        $object = new Mock\RenderableObject('string');

        $this->assertEquals('my-helper', $helper($object));
    }
}
