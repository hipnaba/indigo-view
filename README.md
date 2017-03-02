# Indigo View

[![Build Status](https://travis-ci.org/hipnaba/indigo-html.svg?branch=master)](https://travis-ci.org/hipnaba/indigo-html.svg?branch=master)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/2994f47c98674986ad008011fe0a80ed)](https://www.codacy.com/app/hipnaba/indigo-view?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=hipnaba/indigo-view&amp;utm_campaign=Badge_Grade)
[![Codacy Badge](https://api.codacy.com/project/badge/Coverage/2994f47c98674986ad008011fe0a80ed)](https://www.codacy.com/app/hipnaba/indigo-view?utm_source=github.com&utm_medium=referral&utm_content=hipnaba/indigo-view&utm_campaign=Badge_Coverage)

Indigo View extends [Zend View](https://docs.zendframework.com/zend-view/).
It simplifies integrations with non ZF projects and provides a set of
generally useful view helpers.

## View helpers

### Indent

Indents multiline strings. Helps in generating pretty output. 

```php
<?php
$content = <<< EOS
Line 1
EOS;

$content1 = <<< EOS
Line 1.1
Line 1.2
EOS;

echo '<div>' . PHP_EOL 
        . ($this->indent($content)) . PHP_EOL
            . ($this->indent($content1, 2)) . PHP_EOL
    . '</div>';
```

The above example will output...

```html
<div>
    Line 1
        Line 1.1
        Line 1.2
</div>
```

### RenderObject

Tries to render an object. This is used mainly for rendering objects implementing
[HelperPluginAwareInterface](src/HelperPluginAwareInterface.php).

If the passed object doesn't implement HelperPluginAwareInterface the helper will
try to call the object's __toString() method. If that doesn't exist it will just
return the object's class.

Implementing HelperPluginAwareInterface is simple. Just have the implementing object
return the wanted helper plugin. The helper plugin can be any callable.

```php
<?php
class RenderableObject implements \Indigo\View\HelperPluginAwareInterface
{
    public function getHelperPlugin()
     {
        return function ($object) {
            return '<h1>' . get_class($object) . '</h1>';
        };
    }
}

$object = new RenderableObject();

echo $this->renderObject($object);
```

The above example will output

```html
<h1>RenderableObject</h1>
```

Or we can use the plugin name registered with the plugin manager.

```php
<?php
class RenderableObject implements \Indigo\View\HelperPluginAwareInterface
{
    public function getHelperPlugin() 
    {
        return 'pluginName';
    }
}
```