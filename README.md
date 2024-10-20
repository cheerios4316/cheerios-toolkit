# cheerios-toolkit
my own little website starter toolkit i use for my projects :)

## Run
Run `composer install`, `npm install` and `npm run build`

`npm run build` builds the CSS for the project.
Tailwind init file is located in `/tailwind/init.css`

## Create a new page
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

