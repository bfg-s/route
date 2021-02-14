# Use PHP 8 attributes to register routes in a Laravel app

[![Latest Version on Packagist](https://img.shields.io/packagist/v/bfg/route.svg?style=flat-square)](https://packagist.org/packages/bfg-s/route)

This package provides annotations to automatically register routes. Here's a quick example:

```php
use Bfg\Route\Attributes\Get;

class MyController
{
    #[Get('my-route')]
    public function myMethod()
    {

    }
}
```

This attribute will automatically register this route:

```php
Route::get('my-route', [MyController::class, 'myMethod']);
```

## Installation

You can install the package via composer:

```bash
composer require bfg/route
```

## Usage

In your `RouteServiceProvider`, delete where your controllers are located and he will do the rest for you:
```php
public function boot()
{
    $this->configureRateLimiting();

    $this->routes(function () {

        Route::find(
            // Path for search attributes,
            // you can use class namespaces,
            // directories and file paths
            __DIR__ . '/../Http/Controllers',
            
            // Here you can transfer the parent
            // instance of the route from which
            // the nesting will be created.
            Route::middleware('web')
        );
    });
}
```

The package provides several annotations that should be put on controller classes and methods. These annotations will be used to automatically register routes

### Adding a GET route

```php
use Bfg\Route\Attributes\Get;

class MyController
{
    #[Get('my-route')]
    public function myMethod()
    {

    }
}
```

This attribute will automatically register this route:

```php
Route::get('my-route', [MyController::class, 'myMethod']);
```

### Using other HTTP verbs

We have left no HTTP verb behind. You can use these attributes on controller methods.

```php
#[Bfg\Route\Attributes\Post('my-uri')]
#[Bfg\Route\Attributes\Put('my-uri')]
#[Bfg\Route\Attributes\Patch('my-uri')]
#[Bfg\Route\Attributes\Delete('my-uri')]
#[Bfg\Route\Attributes\Options('my-uri')]
```

### Specify a route name

All HTTP verb attributes accept a parameter named `name` that accepts a route name.

```php
use Bfg\Route\Attributes\Get;

class MyController
{
    #[Get('my-route', name: "my-route-name")]
    public function myMethod()
    {

    }
}
```

This attribute will automatically register this route:

```php
Route::get('my-route', [MyController::class, 'myMethod'])->name('my-route-name');
```

### Adding middleware

All HTTP verb attributes accept a parameter named `middleware` that accepts a middleware class or an array of middleware classes.

```php
use Bfg\Route\Attributes\Get;

class MyController
{
    #[Get('my-route', middleware: MyMiddleware::class)]
    public function myMethod()
    {

    }
}
```

This annotation will automatically register this route:

```php
Route::get('my-route', [MyController::class, 'myMethod'])->middleware(MyMiddleware::class);
```

To apply middleware on all methods of a class you can use the `Middleware` attribute. You can mix this with applying attribute on a method.

```php
use Bfg\Route\Attributes\Get;
use Bfg\Route\Attributes\Middleware;

#[Middleware(MyMiddleware::class)]
class MyController
{
    #[Get('my-route')]
    public function firstMethod()
    {
    }

    #[Get('my-other-route', middleware: MyOtherMiddleware::class)]
    public function secondMethod()
    {
    }
}
```

These annotations will automatically register these routes:

```php
Route::get('my-route', [MyController::class, 'firstMethod'])->middleware(MyMiddleware::class);
Route::get('my-other-route', [MyController::class, 'secondMethod'])->middleware([MyMiddleware::class, MyOtherMiddleware]);
```

### Specifying a prefix

You can use the `Prefix` annotation on a class to prefix the routes of all methods of that class.

```php
use Bfg\Route\Attributes\Get;
use Bfg\Route\Attributes\Post;
use Bfg\Route\Attributes\Prefix;

#[Prefix('my-prefix')]
class MyController
{
    #[Get('my-get-route')]
    public function myGetMethod()
    {
    }

    #[Post('my-post-route')]
    public function myPostMethod()
    {
    }
}
```

These annotations will automatically register these routes:

```php
Route::get('my-prefix/my-get-route', [MyController::class, 'myGetMethod']);
Route::post('my-prefix/my-post-route', [MyController::class, 'myPostMethod']);
```

### Specifying a domain

You can use the `Domain` annotation on a class to prefix the routes of all methods of that class.

```php
use Bfg\Route\Attributes\Get;
use Bfg\Route\Attributes\Post;
use Bfg\Route\Attributes\Domain;

#[Domain('my-subdomain.localhost')]
class MyController
{
    #[Get('my-get-route')]
    public function myGetMethod()
    {
    }

    #[Post('my-post-route')]
    public function myPostMethod()
    {
    }
}
```

These annotations will automatically register these routes:

```php
Route::get('my-get-route', [MyController::class, 'myGetMethod'])->domain('my-subdomain.localhost');
Route::post('my-post-route', [MyController::class, 'myPostMethod'])->domain('my-subdomain.localhost');
```

## Deployment
As stated in the documentation which you can see [here](https://laravel.com/docs/8.x/deployment#optimizing-route-loading). After you cache your routes ...
```bash
php artisan route:cache
```
... scanning of your classes will be disabled.

## Testing

``` bash
cd vendor/bfg/route
composer install
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
