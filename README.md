# Indigo View

Indigo View extends [Zend View](https://docs.zendframework.com/zend-view/).
It simplifies integrations with non ZF projects and provides a set of
generally useful view helpers.

## Renderable

Any object can implement [RenderableInterface](src/RenderableInterface.php) and
be rendered by the view helper plugin defined by the object itself.

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
<h1>REnderableObject</h1>
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