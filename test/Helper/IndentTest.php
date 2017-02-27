<?php
namespace IndigoTest\View\Helper;

use Indigo\View\Helper\Indent;
use PHPUnit\Framework\TestCase;

/**
 * Indent helper test.
 *
 * @package IndigoTest\View\Helper
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-view
 */
class IndentTest extends TestCase
{
    /**
     * Invokable interface returns the correct values.
     *
     * @return void
     */
    public function testInvokableInterface()
    {
        $helper = new Indent();

        $this->assertSame($helper, $helper());
        $this->assertTrue(is_string($helper('some string')));
    }

    /**
     * The helper can indent multiline strings.
     *
     * @return void
     */
    public function testHelperWorksAsAdvertised()
    {
        $helper = new Indent();

        $source = <<< EOS
<div>
    <h1>Title</h1>
    <p>
        <img>
    </p>
</div>
EOS;
        $expected2 = <<< EOS
  <div>
      <h1>Title</h1>
      <p>
          <img>
      </p>
  </div>
EOS;
        $expected4 = <<< EOS
    <div>
        <h1>Title</h1>
        <p>
            <img>
        </p>
    </div>
EOS;

        $this->assertEquals($expected4, $helper($source));

        $helper->setWidth(2);

        $this->assertEquals($expected2, $helper($source));
        $this->assertEquals($expected4, $helper($source, 2));
    }

    /**
     * The helper can be configured via the constructor.
     *
     * @return void
     */
    public function testPassingOptionsThroughConstructorWorks()
    {
        $helper = new Indent(['width' => 3]);

        $this->assertEquals(3, $helper->getWidth());
    }


}
