<?php
namespace IndigoTest\View\Helper;

use Indigo\View\Helper\AbstractHelper;
use Indigo\View\Helper\Indent;
use Indigo\View\Helper\RenderObject;
use PHPUnit\Framework\TestCase;

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
}
