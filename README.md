# cheerios-toolkit
my own little website starter toolkit i use for my projects :)

## Run
Run `composer install`, `npm install` and `npm run build`

`npm run build` builds the CSS for the project.
Tailwind init file is located in `/tailwind/init.css`

# Creating a web page
To create a new page at a given URL (like "/examplepage/"):
- Create a new class inside `src/Controllers`that extends `BaseController` and implements `ControllerInterface`:

```php
class ExampleController extends BaseController implements ControllerInterface
{
    public function generatePage(): PageComponent
    {
        return $this->container->create(ExamplePageComponent::class);
    }

    public static function getUrl(): string
    {
        // This is the URL that will istantiate this controller
        return 'examplepage';
    }
}
```
More on the container later.

- Create a new class inside `src/Components/PageComponent/ExamplePageComponent` that extends `PageComponent`. More on components later

```php
class ExamplePageComponent extends PageComponent
{

    protected $name = 'example_page';
    protected $area = 'PageComponent/ExamplePageComponent';

    protected string $text = 'Sample Text';

    public function getText(): string
    {
        return $this->text;
    }
}
```

- Create a view file `example_page.php` in the same folder as your class `ExamplePageComponent`:
```php
<div class="example-page-component">
    <?= $this->getText() ?>
</div>
```

Now the URL yourwebsite.domain/examplepage/ will display a page with the text "Sample text".

# About components

To create a component, create a new class that extends `Component`. Make an `ExampleComponent` folder inside the path `/src/Components` and create `ExampleComponent.php`:

```php

class ExampleComponent extends Component
{
    protected $name = 'example';
    protected $area = 'ExampleComponent';
}

```

`$name` is the name of the files that will make the HTML / JS / CSS template of the component, while `$area` is the name of the subfolder of `/src/Components` in which the files are located.

Now that you've created the class, create a file `example.php` in the same directory:
```html
<div class="example-component">
    Some content for the component
</div>
```