<p align="center">
    <a href="https://www.mangoweb.cz/en/" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/38423357?s=200&v=4"/>
    </a>
</p>
<h1 align="center">Sorting Plugin</h1>

## Features

* Sort products in taxons by simple drag and drop

<p align="center">
	<img src="https://raw.githubusercontent.com/mangoweb-sylius/SyliusSortingPlugin/master/doc/sorting.png"/>
</p>

## Installation

1. Run `$ composer require mangoweb-sylius/sylius-sorting-plugin`.
2. Register `\MangoSylius\SortingPlugin\MangoSyliusSortingPlugin` in your Kernel.
3. Import `@MangoSyliusSortingPlugin/Resources/config/routing.yml` in the routing.yml.

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
