# Indigo View

[![Build Status](https://travis-ci.org/hipnaba/indigo-html.svg?branch=master)](https://travis-ci.org/hipnaba/indigo-html.svg?branch=master)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/2994f47c98674986ad008011fe0a80ed)](https://www.codacy.com/app/hipnaba/indigo-view?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=hipnaba/indigo-view&amp;utm_campaign=Badge_Grade)
[![Codacy Badge](https://api.codacy.com/project/badge/Coverage/2994f47c98674986ad008011fe0a80ed)](https://www.codacy.com/app/hipnaba/indigo-view?utm_source=github.com&utm_medium=referral&utm_content=hipnaba/indigo-view&utm_campaign=Badge_Coverage)

Indigo View extends [Zend View](https://docs.zendframework.com/zend-view/).
It simplifies integrations with non ZF projects and provides a set of
generally useful view helpers.

## Renderable

Any object can implement [RenderableInterface](src/RenderableInterface.php) and
be rendered by the view helper plugin defined by the object itself. A helper
plugin is provided to render such objects.

The helper plugin can be any callable.

```php
<?php
class RenderableObject implements \Indigo\View\RenderableInterface
{
    public function getHelperPlugin()
     {
        return function ($object) {
            return '<h1>' . get_class($object) . '</h1>';
        };
    }
}

$object = new RenderableObject();

echo $this->renderable($object);
```

The above example will output

```html
<h1>RenderableObject</h1>
```

Or we can use the plugin name registered with the plugin manager.

```php
<?php
class RenderableObject implements \Indigo\View\RenderableInterface
{
    public function getHelperPlugin() 
    {
        return 'pluginName';
    }
}
```