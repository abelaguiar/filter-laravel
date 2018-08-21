# Filters in laravel


[![PHP from Packagist](https://img.shields.io/packagist/php-v/abelaguiar/filter-laravel.svg)](https://packagist.org/packages/abelaguiar/filter-laravel) [![Packagist](https://img.shields.io/packagist/l/abelaguiar/filter-laravel.svg)](https://packagist.org/packages/abelaguiar/filter-laravel) [![Packagist](https://img.shields.io/packagist/vpre/abelaguiar/filter-laravel.svg)](https://packagist.org/packages/abelaguiar/filter-laravel) [![Build Status](https://travis-ci.org/abelaguiar/filter-laravel.svg?branch=master)](https://travis-ci.org/abelaguiar/filter-laravel)

The `abelaguiar/filter-laravel` package provides easy to use functions to simples filters in laravel.

#### Install Package
```bash
composer require abelaguiar/filter-laravel
```

Use `php artisan` to view the list of commands associated with filters.

#### Create filters:

```bash
php artisan filter:model <Model>
```

#### Create field:

```bash
php artisan filter:field <Name>
```

When creating a filter, inside the class we have an array, where you will put the fields you want to use as filters in your model.

Example filter class with fields implemention:

```php
use App\Filters\Fields\TitleField;
use AbelAguiar\Filter\AbstractFilter;

class PostClass extends AbstractFilter
{
    protected $filters = [
        'title' => TitleField::class
    ];
}
```

Example field class:

```php
class TitleField
{
    public function filter($builder, $value)
    {
        return $builder->where('title', $value);
    }
}
```

Created the filters, in the model that you want to connect filters, you will put:

```php
use AbelAguiar\Filter\RequestFilter;

class Post
{
    use RequestFilter;
...
```

If you want to set up a different filter path, use the variable below within the model:

```php
protected static $filter = 'App\Filters\PostFilter';
...
```

Finally, when calling your model anywhere in your application, just call the method `filter` by passing the request, thus returning all data from the buca, as in the example below:

```php
Post::filter($request)->get()
```