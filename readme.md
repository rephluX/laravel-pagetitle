# Manage your Page Title

[![Build Status](https://travis-ci.org/rephluX/laravel-pagetitle.svg?branch=master)](https://travis-ci.org/rephluX/laravel-pagetitle)
[![Latest Stable Version](https://poser.pugx.org/rephlux/pagetitle/v/stable.svg)](https://packagist.org/packages/rephlux/pagetitle)
[![License](https://poser.pugx.org/rephlux/pagetitle/license.svg)](https://packagist.org/packages/rephlux/pagetitle)

Often, you'll find yourself in situations, where you want to have more to control how to set a page title for your
different views. Although it is possible to yield your page title in a master view it can be a hassle to deal with
the format like a delimeter usage or to append/prepend a default page title.

This package simplifies the process.

## Installation

Begin by installing this package through Composer.

```js
{
    "require": {
		"rephlux/pagetitle": "0.1.*"
	}
}
```

### Laravel Users

If you are a Laravel user, then there is a service provider that you can make use of to automatically prepare the bindings and such.

```php

// app/config/app.php

'providers' => [
    '...',
    'Rephlux\PageTitle\PageTitleServiceProvider'
];
```

When this provider is booted, you'll have a nice little `PageTitle` facade, which you may use in your controllers and views.

```php
public function index()
{
    PageTitle::add('Hello there');

    return View::make('hello');
}
```

To add multiple page title parts at once just pass an array as parameter.

```php
public function index()
{
    PageTitle::add([
        'Hello there',
        'Profile'
    ]);

    return View::make('hello');
}
```

Now you can display the fully concatenated page title in your view. The best way is to use it in your master layout file.

```html
<head>
    <meta charset="UTF-8">
    <title>{{ PageTitle:get() }}</title>
    ...
</head>
```

To display the fully concatenated page title in reverse order just pass an appropriate parameter.

```html
<head>
    <meta charset="UTF-8">
    <title>{{ PageTitle:get('reverse') }}</title>
    ...
</head>
```

### Defaults

If using Laravel, there are three configuration options that you'll need to worry about. First, publish the default configuration.

```bash
php artisan config:publish rephlux/pagetitle
```

This will add a new configuration file to: `app/config/packages/rephlux/pagetitle`.

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

[View the license](https://github.com/laracasts/PHP-Vars-To-Js-Transformer/blob/master/LICENSE) for this repo.
