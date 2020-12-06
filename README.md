# Laravel Flash Alerts
Automatically flash success alerts in your resource controllers: `store`, `update` and `destroy` methods.

[![Latest Version](https://img.shields.io/packagist/v/royvoetman/laravel-flash-alerts.svg?style=flat-square)](https://packagist.org/packages/royvoetman/laravel-flash-alerts)
[![MIT Licensed](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Total Downloads](https://img.shields.io/packagist/dt/royvoetman/laravel-flash-alerts.svg?style=flat-square)](https://packagist.org/packages/royvoetman/laravel-flash-alerts)

## Installation

```bash
composer require royvoetman/laravel-flash-alerts
```

Add FlashAlerts middleware to the routeMiddleware array in app/Http/Kernel.php
```php
 /**
  * The application's route middleware.
  *
  * These middleware may be assigned to groups or used individually.
  *
  * @var array
  */
 protected $routeMiddleware = [
    ...
    'flash.alerts' => \RoyVoetman\LaravelFlashAlerts\Middleware\FlashAlerts::class
 ];
```

Add the FlashesAlerts trait to your applications BaseController
```php
<?php

namespace App\Http\Controllers;

use RoyVoetman\LaravelFlashAlerts\Traits\FlashesAlerts;
...

abstract class Controller extends BaseController
{
    use FlashesAlerts;

    ...
}
```

## Signature
```php
public function registerAlertMiddleware(string $model, array $except = []);
```
* $model
    * A string used in the flash messages for example `$model = 'Book'` will result in: `The Book has been successfully added`
* $except
    * An array of methods that are skipped while registering middleware.

## Usage

If the middleware is registered and a `store`, `update` or `destory` method has been successfully executed.
A success message will be flashed in the current session under the key `alert`.

If the current session has a message under the key `warning` or an exception is thrown, the request will not be considered successful.


### Example
```php
<?php

namespace App\Http\Controllers;

class BookController extends Controller
{    
    /**
     * BookController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->registerAlertMiddleware('Book');
    }
    
    ...
}
```

#### Ignoring methods
```php
<?php

namespace App\Http\Controllers;

class BookController extends Controller
{    
    /**
     * BookController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->registerAlertMiddleware('Book', ['destroy']);
    }
    
    public function store()
    {
        // Will flash alert

        return redirect()->route('books.index');
    }

    public function destroy()
    {
        // Won't flash alert

        return redirect()->route('books.index');
    }
    ...
}
```

### Displaying flash alerts
```blade
@if (session()->has('alert'))
    <div class="alert alert-success" role="alert">
        {{ session('alert') }}
    </div>
@endif
```

## Change Alert messages

```php
php artisan vendor:publish --provider="RoyVoetman\LaravelFlashAlerts\FlashAlertsServiceProvider" 
```

This will place the overwritable translations under `resources/lang/vendor/laravel-flash-alerts`

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Contributions are **welcome** and will be fully **credited**. We accept contributions via Pull Requests on [Github](https://github.com/RoyVoetman/laravel-flash-alerts).

### Pull Requests

- **[PSR-2 Coding Standard](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)** - The easiest way to apply the conventions is to install [PHP Code Sniffer](http://pear.php.net/package/PHP_CodeSniffer).
- **Document any change in behaviour** - Make sure the `README.md` and any other relevant documentation are kept up-to-date.
- **Create feature branches** - Don't ask us to pull from your master branch.
- **One pull request per feature** - If you want to do more than one thing, send multiple pull requests.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
