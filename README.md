Bauhaus - The missing Laravel 4 Admin Generator
---
Bauhaus is an admin generator / builder / interface for [Laravel](http://laravel.com).
With Bauhaus you can easily create visual stunning lists, forms and filters for your models.

Installation
---
Add bauhaus to your composer.json file:
```
"require": {
	"krafthaus/bauhaus": "dev-master"
}
```

Use composer to install this package.
```
$ composer update
```

### Registering the package
```php
'providers' => array(
	// ...
	'KraftHaus\Bauhaus\BauhausServiceProvider',
	'Intervention\Image\ImageServiceProvider',
)
```

Add the `admin` folder to the `app/` directory and put the following line in your composer.json file:
```
"autoload": {
	"classmap": [
		"app/admin"
	]
},
```

Then publish the config file with `php artisan config:publish krafthaus/bauhaus`.
This will add the main bauhaus config file in your application config directory.

And last but not least you need to publish to package's assets with the `php artisan asset:publish krafthaus/bauhaus` command.

License
---
This package is available under the [MIT license](LICENSE).