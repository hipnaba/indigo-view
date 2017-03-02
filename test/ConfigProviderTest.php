<?php
namespace IndigoTest\View;

use Indigo\View\ConfigProvider;
use Indigo\View\Helper\Indent;
use Indigo\View\Helper\RenderObject;
use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceManager;
use Zend\View\HelperPluginManager;

/**
 * Test the configuration.
 *
 * @package IndigoTest\View
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-view
 */
class ConfigProviderTest extends TestCase
{
    /**
     * It will provide view helper manager configuration.
     *
     * @return void
     */
    public function testWillConfigureHelperPluginManager()
    {
        $container = new ServiceManager();
        $config = new ConfigProvider();

        $helpers = new HelperPluginManager($container, $config->getViewHelperConfig());

        $this->assertTrue($helpers->has('indent'));
        $this->assertInstanceOf(Indent::class, $helpers->get('indent'));

        $this->assertTrue($helpers->has('renderObject'));
        $this->assertInstanceOf(RenderObject::class, $helpers->get('renderObject'));
    }
}
