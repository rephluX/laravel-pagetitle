# Manage the Page Title in Blade views

[![Build Status](https://travis-ci.org/rephluX/laravel-pagetitle.svg?branch=master)](https://travis-ci.org/rephluX/laravel-pagetitle)
[![Latest Stable Version](https://poser.pugx.org/rephlux/pagetitle/v/stable.svg)](https://packagist.org/packages/rephlux/pagetitle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/rephluX/laravel-pagetitle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/rephluX/laravel-pagetitle/?branch=master)
[![License](https://poser.pugx.org/rephlux/pagetitle/license.svg)](https://packagist.org/packages/rephlux/pagetitle)

Often, you'll find yourself in situations, where you want to have more to control how to set a page title for your
different views. Although it is possible to yield your page title in a master view it can be a hassle to deal with
the format like a delimeter usage or to append/prepend a default page title.

This package simplifies the process.

## Installation

Begin by installing this package through Composer:

```bash
composer require rephlux/pagetitle
```

### Laravel Users

If you are a Laravel user, then there is a service provider that need to add to your `config/app.php` file.

```php
'providers' => [
    '...',
    Rephlux\PageTitle\PageTitleServiceProvider::class
];
```

This package also provides a facade, which you may also register in your `config/app.php` as well if you want to use the facade in your controllers and views:
 
```php
 'aliases' => [
     '...'
     'PageTitle' => Rephlux\PageTitle\Facades\PageTitle::class,
 ]
```
  
## Useage 
 
 To simple add a single page title, call the appropiate `add()` method with passing a string as a parameter:
 
```php
public function index()
{
    \PageTitle::add('Welcome to our Homepage');

    return view('hello');
}
```

You can also make use of the global `pagetitle` helper function.

```php
public function index()
{
    pagetitle('Welcome to our Homepage');

    return view('hello');
}
```

To add multiple page title parts at once just pass an array as a parameter.

```php
public function index()
{
    pagetitle([
        'About us',
        'Profile'
    ]);

    return view('hello');
}
```

### Add the pagetitle to a blade view

Now you can display the fully concatenated page title in your view. The best way is to use it in your master layout file.

```html
<head>
    <meta charset="UTF-8">
    <title>{{ pagetitle->get() }}</title>
    ...
</head>
```

To display the fully concatenated page title in reverse order just pass the `reverse` parameter.

```html
<head>
    <meta charset="UTF-8">
    <title>{{ pagetitle->get(('reverse') }}</title>
    ...
</head>
```

The `downward` mode first concatenates all page title parts in reverse order and then appends the page name ( _if set in options_ )

```html
<head>
    <meta charset="UTF-8">
    <title>{{ pagetitle->get(('downward') }}</title>
    ...
</head>
```

### Defaults

If using Laravel, there are three configuration options that you'll need to worry about. First, publish the default configuration with the following command:

```bash
php artisan vendor:publish --provider="Rephlux\PageTitle\PageTitleServiceProvider"
```

This will add a new configuration file to: `config/pagetitle.php`.

```php

<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Page name
    |--------------------------------------------------------------------------
    |
    | Type your page name for your website.
    | This will be used when there are more titles to concatenate with.
    |
    */
    'page_name' => '',

    /*
    |--------------------------------------------------------------------------
    | Default title when empty
    |--------------------------------------------------------------------------
    |
    | This will be used when therer is no other title.
    | Mainly used for the home page of your website.
    |
    */
    'default_title_when_empty' => '',

    /*
    |--------------------------------------------------------------------------
    | Delimiter
    |--------------------------------------------------------------------------
    |
    | Titles will be concatenated using this delimiter.
    |
    */
    'delimiter' => ' :: '

];
```

#### page_name

If you want you can enter your page name to this key if you want to append/prepend the name to your concatenated page title.

#### default_title_when_empty

This text will be used when there is are no page title parts in the collection.

#### delimiter

When you want to use a delimeter just update this key and add the string you want to use as an delimeter.

## License

[View the license](https://github.com/rephluX/laravel-pagetitle/blob/master/LICENSE) for this repo.
