<?php
namespace IndigoTest\View\Renderer;

use Indigo\View\Renderer\PhpRenderer;
use IndigoTest\View\Mock\RenderableObject;
use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceManager;
use Zend\View\Helper\HelperInterface;
use Zend\View\HelperPluginManager;

/**
 * PhpRenderer tests.
 *
 * @package IndigoTest\View\Renderer
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-view
 */
class PhpRendererTest extends TestCase
{
    /**
     * The default plugin manager should be configured with Indigo\View helpers.
     *
     * @return void
     */
    public function testIndigoHelpersAreInstalled()
    {
        $renderer = new PhpRenderer();

        $this->assertInstanceOf(HelperInterface::class, $renderer->plugin('renderable'));
    }

    /**
     * Renderer will allow other plugin managers to be set.
     *
     * @return void
     */
    public function testPluginManagerWillNotBeOverwritterByDefault()
    {
        $renderer = new PhpRenderer();
        $manager = new HelperPluginManager(new ServiceManager());

        $renderer->setHelperPluginManager($manager);

        $this->assertSame($manager, $renderer->getHelperPluginManager());
    }

    /**
     * Renderer can render objects implementing RenderableInterface.
     *
     * @return void
     */
    public function testRenderCanRenderRenderableObjects()
    {
        $renderer = new PhpRenderer();
        $object = new RenderableObject(function () {
            return 'rendered';
        });

        $this->assertEquals('rendered', $renderer->render($object));
    }
}