<?php
namespace IndigoTest\View\Renderer;

use Indigo\View\Renderer\PhpRenderer;
use PHPUnit\Framework\TestCase;
use Zend\View\Helper\HelperInterface;

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
}