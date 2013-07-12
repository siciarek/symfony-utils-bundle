symfony-utils-bundle
====================

Symfony2 scripts and utilities.

Overview
--------

 * ``{{ accept_cookies() }}`` cookie privacy policy bar as a twig function
 * ``config/cli-config.php`` configuration file for ``bin/doctrine``
 * ``bin/selenium`` selenium server script with all dependencies
 * ``bin/xbehat`` behat script with gherkin i18n configuration support

Installation
------------

Add SiciarekSymfonyUtilsBundle in your composer.json:

```js
{
    "require": {
        "siciarek/symfony-utils-bundle": "dev-master"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update siciarek/symfony-utils-bundle
```

Composer will install the bundle to your project's `vendor/siciarek` directory.

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Siciarek\SymfonyUtilsBundle\SiciarekSymfonyUtilsBundle(),
    );
}
```

Privacy policy bar (accept cookies)
-----------------------------------

### Enable

``` yaml
# app/config/config.yml

siciarek_symfony_utils:
    accept_cookies:
        enabled: true
````

### Twig helper

Using default configuration values


``` html+jinja
{{ accept_cookies() }}

```

Using custom url

``` html+jinja
{{ accept_cookies('http://somedomain.com/docs/my-special-privacy-policy' }}

```


### Default configuration

Default values

``` yaml
# app/config/config.yml

siciarek_symfony_utils:
    accept_cookies:
        enabled: false
        stylesheet: /bundles/siciareksymfonyutils/css/cookiesbar.css
        cookie_name: cookies_accepted
        privacy_policy_url: privacy-policy
        template: 'SiciarekSymfonyUtilsBundle:Common:cookiesbar.html.twig'

```
