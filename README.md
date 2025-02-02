# cheerios-toolkit
my own little website starter toolkit i use for my projects :)

## COMING UP!
- Seamless support for Single Page Applications
- Update Tailwind to version 4.0
- Component generation scripts to create functioning components instantly
- General component refactor and optimization

## Run
Run `composer install`, `npm install` and `npm run build`

`npm run build` builds the CSS for the project.

Tailwind init file is located in `/tailwind/init.css`

## Create a web page
Edit this file: `src/Routing/DefaultRouting.php` or any other custom defined routing file.
Add a correspondence into the array returned by the method `getRoutes()`:
```php
return [
            'home' => HomeController::class,
            'my_page' => MyPageController::class
        ];
```

Now navigating to your.current.host/my_page/ will istantiate a `MyPageController` object.

Create a `MyPageController` class. Make it extend BaseController and implement ControllerInterface. `generatePage()` method should return a `PageComponent` object.


## Create a component

Create a class that extends `Component`. Pick a file name that will be used for the resource files for the component (JS, CSS, PHP view file) and assign it to `$name` class prop (example: for `InputComponent` you will have `protected $name = "input"`. The view file is going to be named `input.php` inside the same directory)
To give JS to a component create a JS file for the component and refer to the template found in `component_templates/component_template.js`.

**IMPORTANT** in order for JS components to work, the PHP view of the component must be wrapped in a container that has a class equal to the component's name, but kebab-cased
e.g. MyFantasticComponent's view will look like this:
```html
<div class="my-fantastic-component">
    <!-- some content -->
</div>
```

## Contributing
Don't ;D
