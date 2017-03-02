<?php
namespace Indigo\View\Helper;

/**
 * Indents multiline strings.
 *
 * @package Indigo\View\Helper
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-view
 */
class Indent extends AbstractHelper
{
    /**
     * Indent level width.
     *
     * @var int
     */
    protected $width = 4;

    /**
     * Indent constructor.
     *
     * @param array $options {
     *     Helper options.
     *
     *     @type integer $width Indentation level width.
     * }
     */
    public function __construct(array $options = [])
    {
        if (isset($options['width'])) {
            $this->setWidth($options['width']);
        }
    }

    /**
     * Returns itself or proxies to indent().
     *
     * @param string|null $string The string to indent.
     * @param int         $level  The number of indentation levels.
     *
     * @return Indent|string
     */
    public function __invoke($string = null, $level = 1)
    {
        if (null === $string) {
            return $this;
        }

        return $this->indent($string, $level);
    }

    /**
     * Returns the width of an indentation level in spaces.
     *
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Sets the width of an indentation level.
     *
     * @param int $width The new width.
     *
     * @return void
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * Indents a multiline string.
     *
     * @param string $string The string to indent.
     * @param int    $level  The number of indentation levels.
     *
     * @return string
     */
    public function indent($string, $level = 1)
    {
        $lines = explode(PHP_EOL, $string);

        foreach ($lines as &$line) {
            $line = str_repeat(' ', $this->getWidth() * $level) . $line;
        }

        return implode(PHP_EOL, $lines);
    }
}
