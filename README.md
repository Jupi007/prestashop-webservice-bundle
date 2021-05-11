<h1 align="center">Jupi007 PrestaShop Webservice (Extra) Bundle</h1>

Symfony integration of [PrestaShop Webservice lib](https://github.com/PrestaShop/PrestaShop-webservice-lib) and [PrestaShop Webservice lib Extra](https://github.com/Jupi007/prestashop-webservice-extra).

Prerequisites
=============

This bundle require the [PrestaShop Webservice lib](https://github.com/PrestaShop/PrestaShop-webservice-lib) package which is only available in dev version on packagist.

Before installing this bundle, you must add these lines into the `composer.json` file of your project:

```js
{
    // ...
    "minimum-stability": "dev",
    "prefer-stable": true
}
```

Installation
============

Make sure Composer is installed globally, as explained in the
[installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Applications that use Symfony Flex
----------------------------------

Open a command console, enter your project directory and execute:

```console
$ composer require "jupi007/prestashop-webservice-bundle"
```

Applications that don't use Symfony Flex
----------------------------------------

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require "jupi007/prestashop-webservice-bundle"
```

### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    Jupi007\PrestashopWebserviceBundle\Jupi007PrestashopWebserviceBundle::class => ['all' => true],
];
```

Configuration
=============

Prerequisites
-------------

First at all, you must enable the webservice feature of your PrestaShop store and create an API key access. Please have a look at the official doc: [Creating access to the Webservice](https://devdocs.prestashop.com/1.7/webservice/tutorials/creating-access/).

---

It is recommended to fill secret infos like API keys into `.env.local` file.

To do this, create a `config/packages/jupi007_prestashop_webservice.yaml`:

```yaml
jupi007_prestashop_webservice:
  connection:
    store_root_path: '%env(PRESTA_WEBSERVICE_ROOT_PATH)%'
    authentication_key: '%env(PRESTA_WEBSERVICE_AUTH_KEY)%'
```

And then add these environment variables to your `.env.local`:

```
PRESTA_WEBSERVICE_ROOT_PATH=https://absolute-path-to-your-store.com
PRESTA_WEBSERVICE_AUTH_KEY=ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789
```

Usage
=====

Just inject the service by type-hinting an argument with the `Jupi007\PrestashopWebserviceBundle\Services\PrestashopWebservice` or `PrestashopWebserviceExtra` class:

```php
// src/Controller/ProductController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Jupi007\PrestashopWebserviceBundle\Services\PrestashopWebservice;
// or
use Jupi007\PrestashopWebserviceBundle\Services\PrestashopWebserviceExtra;

class ProductController
{
    /**
     * @Route("/products")
     */
    public function list(PrestashopWebservice $psWebservice): Response
    {
        $products = $psWebservice->get(['resource' => 'products']);

        // ...
    }

    // or

    /**
     * @Route("/products")
     */
    public function list(PrestashopWebserviceExtra $psWebservice): Response
    {
        $products = $psWebservice->initQuery()
                                 ->get('products')
                                 ->executeQuery();

        // ...
    }
}
```

Once you have a `PrestashopWebservice` or `PrestashopWebserviceExtra` instance, you can use it just like the normal corresponding library.

See the official documentation for more informations: https://devdocs.prestashop.com/1.7/webservice/tutorials/prestashop-webservice-lib/

And also the [PrestaShop Webservice lib Extra](https://github.com/Jupi007/prestashop-webservice-extra) repository.
