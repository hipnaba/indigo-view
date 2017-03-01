<?php
namespace IndigoTest\View\Helper;

use Indigo\View\Helper\RenderObject;
use Indigo\View\HelperPluginAwareInterface;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject as MockObject;
use stdClass;
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
        $helper = new RenderObject();

        $this->assertSame($helper, $helper());
        $this->assertTrue(is_string($helper(new stdClass)));
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
        $renderer
            ->method('plugin')
            ->willReturn(function () {
                return 'my-helper';
            });

        $helper = new RenderObject();
        $helper->setView($renderer);

        $object = $this->createMock(HelperPluginAwareInterface::class);
        $object
            ->method('getHelperPlugin')
            ->willReturn('string');

        $this->assertEquals('my-helper', $helper($object));
    }
}
