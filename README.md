<p align="center">
    <a href="https://www.mangoweb.cz/en/" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/38423357?s=200&v=4"/>
    </a>
</p>
<h1 align="center">
Sorting Plugin
<br />
    <a href="https://packagist.org/packages/mangoweb-sylius/sylius-sorting-plugin" title="License" target="_blank">
        <img src="https://img.shields.io/packagist/l/mangoweb-sylius/sylius-sorting-plugin.svg" />
    </a>
    <a href="https://packagist.org/packages/mangoweb-sylius/sylius-sorting-plugin" title="Version" target="_blank">
        <img src="https://img.shields.io/packagist/v/mangoweb-sylius/sylius-sorting-plugin.svg" />
    </a>
    <a href="http://travis-ci.org/mangoweb-sylius/SyliusSortingPlugin" title="Build status" target="_blank">
        <img src="https://img.shields.io/travis/mangoweb-sylius/SyliusSortingPlugin/master.svg" />
    </a>
</h1>

## Features

* Sort products in taxons by simple drag and drop
  * Well-arranged overview of all products in the taxon
  * Disabled products greyed out
  * Direct links into product details
  * Optionally hidden taxon tree to get even more space

<p align="center">
	<img src="https://raw.githubusercontent.com/mangoweb-sylius/SyliusSortingPlugin/master/doc/sorting.png"/>
</p>

## Installation

1. Run `$ composer require mangoweb-sylius/sylius-sorting-plugin`.
2. Register `\MangoSylius\SortingPlugin\MangoSyliusSortingPlugin` in your Kernel.
3. Import `@MangoSyliusSortingPlugin/Resources/config/routing.yml` in the routing.yml with a prefix of /admin.

## Usage

* Log into admin panel
* Click on `Sorting products` in the Catalog section in main menu
* Select taxon
* Drag and drop cards
* Click `Save positions` button in the top right corner

## Development

### Usage

- Create symlink from .env.dist to .env or create your own .env file
- Develop your plugin in `/src`
- See `bin/` for useful commands

### Testing

After your changes you must ensure that the tests are still passing.
```bash
$ composer install
$ bin/phpstan.sh
$ bin/ecs.sh
```

License
-------
This library is under the MIT license.

Credits
-------
Developed by [manGoweb](https://www.mangoweb.eu/).
