AdEspresso Facebook Bundle
==========================

[![Build Status](https://img.shields.io/travis/adespresso/FacebookBundle.svg?style=flat)](https://travis-ci.org/adespresso/FacebookBundle)
[![Coverage Status](https://img.shields.io/coveralls/adespresso/FacebookBundle.svg?style=flat)](https://coveralls.io/r/adespresso/FacebookBundle)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/adespresso/FacebookBundle.svg?style=flat)](https://scrutinizer-ci.com/g/adespresso/FacebookBundle/)
[![Total Downloads](https://img.shields.io/packagist/dt/adespresso/facebook-bundle.svg?style=flat)](https://packagist.org/packages/adespresso/facebook-bundle)

Symfony Bundle for Facebook interactions' management.

Step 1: Download the Bundle
---------------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```bash
$ composer require adespresso/facebook-bundle
```

This command requires you to have [Composer](https://getcomposer.org/) installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Step 2: Enable the Bundle
-------------------------

Then, enable the bundle by adding the following line in the `app/AppKernel.php`
file of your project:

```php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new AdEspresso\FacebookBundle\FacebookBundle(),
        );
    }
}
```

Step 3: Configure the Bundle
----------------------------

```yaml
# app/config/config.yml
facebook:
    sdk:
        config:
            app_id: 'your_id'
            app_secret: 'your_secret'
    ads:
        config:
            app_id: 'your_id'
            app_secret: 'your_secret'
```

Documentation
-------------

The source of the documentation is stored in the `Resources/doc/` folder in this bundle:

[Read the Documentation for master](https://github.com/adespresso/FacebookBundle/tree/master/Resources/doc/index.rst)
