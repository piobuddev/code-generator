# Code-Generator

Command line tool for generating files from provided templates.

## Usage

`$ php application generate /path/to/templates path/for/output path/to/config.json`

See `./examples` for code examples.
Run below to recreate examples.
```sh
$ rm -r  ./examples/output/Bar/ ./examples/output/Fred/ ./examples/output/freds/ ./examples/output/Waldo/ ./examples/output/waldos/
$ php application generate ./examples/templates/ ./examples/output/ ./examples/config.json
```

## Development setup:
### Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites
* PHP >= `7.4`
* [Composer](https://getcomposer.org/): tool for dependency management in PHP

### Installing

To get the development environment running clone the repository and run the composer

```sh
$ git clone git@github.com:piobuddev/code-generator.git
$ cd code-generator/
$ composer install
```

## Running the tests

### Coding style tests
##### PHPStan : PHP Static Analysis Tool

```sh
$ vendor/bin/phpstan analyse -l 7 src tests -c phpstan.neon
```
##### PHPCS : Detects violations of a defined set of coding standards

```sh
$ vendor/bin/phpcs --standard=PSR2 --extensions=php --colors --severity=1 src
```

Additionally, you can fix code formatting with:
##### PHPCBF : PHP Code Beautifier and Fixer

```sh
$ vendor/bin/phpcbf --standard=PSR2 --extensions=php --colors --severity=1 src
```

### PHPUNIT

```sh
$ vendor/bin/phpunit --testdox
```

## Built With
* [The Console Component](https://symfony.com/doc/current/components/console.html) The Console component allows you to create command-line commands.
* [Twig](https://twig.symfony.com/) - A modern template engine for PHP.
* [The DependencyInjection Component](https://symfony.com/doc/current/components/dependency_injection.html) - The DependencyInjection component implements a PSR-11 compatible service container that allows you to standardize and centralize the way objects are constructed in your application.
* [The Config Component](https://symfony.com/doc/current/components/config.html) - The Config component provides several classes to help you find, load, combine, fill and validate configuration values of any kind, whatever their source may be (YAML, XML, INI files, or for instance a database).
* [The Yaml Component](https://symfony.com/doc/current/components/yaml.html) - The Yaml component loads and dumps YAML files.
* [The Finder Component](https://symfony.com/doc/current/components/finder.html) -  The Finder component finds files and directories based on different criteria (name, file size, modification time, etc.) via an intuitive fluent interface.


## Code Style
* [PSR2](https://www.php-fig.org/psr/psr-2/)


## Contributing

Please read [CONTRIBUTING.md](https://gist.github.com/piobuddev/c04b7341f68da9718907cb593012d746) for details on my code of conduct, and the process for submitting pull requests to me.

## Versioning

I use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/piobuddev/code-generator/tags). 

## Authors

* **Piotr Budny** - [piobuddev](https://github.com/piobuddev)

## License

This project is licensed under the MIT License - see the [LICENSE.md](https://github.com/piobuddev/code-generator/blob/master/LICENSE.md) file for details
