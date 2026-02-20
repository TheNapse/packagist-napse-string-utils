### Overview

The `StringUtils` class provides several utility methods for transforming strings into various casing styles. The
library can be used to convert strings to formats like:

* flatcase
* kebab-case
* camelCase
* PascalCase
* snake_case
* CONSTANT_CASE
* COBOL-CASE

### Installation

To include the package in your project, you can require it via Composer:

``` bash
composer require napse/string-utils
```

### Usage

Below are examples demonstrating how to use each public method of the `StringUtils` class:

#### 1. **Flatcase**

Converts a string to flatcase by removing all non-alphanumeric characters and lowercasing it.

``` php
use Napse\StringUtils\StringUtils;

echo StringUtils::toFlatCase('Hello World! 123'); 
// Output: helloworld123
```

#### 2. **Kebab-case**

Converts a string to kebab-case by replacing non-alphanumeric characters with hyphens and lowercasing it.

``` php
use Napse\StringUtils\StringUtils;

echo StringUtils::toKebabCase('Hello World! 123'); 
// Output: hello-world-123
```

#### 3. **CamelCase**

Converts a string to camelCase format.

``` php
use Napse\StringUtils\StringUtils;

echo StringUtils::toCamelCase('Hello World! 123'); 
// Output: helloWorld123
```

#### 4. **PascalCase**

Converts a string to PascalCase format.

``` php
use Napse\StringUtils\StringUtils;

echo StringUtils::toPascalCase('Hello World! 123'); 
// Output: HelloWorld123
```

#### 5. **Snake_case**

Converts a string to snake_case format.

``` php
use Napse\StringUtils\StringUtils;

echo StringUtils::toSnakeCase('Hello World! 123'); 
// Output: hello_world_123
```

#### 6. **CONSTANT_CASE**

Converts a string to CONSTANT_CASE format (uppercase snake_case).

``` php
use Napse\StringUtils\StringUtils;

echo StringUtils::toConstantCase('Hello World! 123'); 
// Output: HELLO_WORLD_123
```

#### 7. **COBOL-CASE**

Converts a string to COBOL-CASE format (uppercase kebab-case).

``` php
use Napse\StringUtils\StringUtils;

echo StringUtils::toCobolCase('Hello World! 123'); 
// Output: HELLO-WORLD-123
```

### Version Class

The `Version` class allows easy management of semantic versions and provides methods for modifying and validating versions.

#### Creating a Version

```php
use Napse\StringUtils\Version;

$version = new Version(1, 2, 3, 'beta', 'build123');
echo $version; // 1.2.3-beta+build123
```

#### Creating a Version from a String

```php
$version = Version::fromString('2.1.0-beta+exp.sha.5114f85');
echo $version; // 2.1.0-beta+exp.sha.5114f85
```

#### Getting Version Components

```php
$version = new Version(1, 2, 3, 'alpha', 'build123');

echo $version->getMajor(); // 1
echo $version->getMinor(); // 2
echo $version->getPatch(); // 3
echo $version->getPreRelease(); // alpha
echo $version->getBuildMetadata(); // build123
```

#### Incrementing the Version

```php
$version = new Version(1, 2, 3);

echo $version->incrementMajor(); // 2.0.0
echo $version->incrementMinor(); // 1.3.0
echo $version->incrementPatch(); // 1.2.4
```

#### Modifying the Version

```php
$version = new Version(1, 0, 0);

$newVersion = $version->withMajor(2);
echo $newVersion; // 2.0.0

$newVersion = $version->withMinor(5);
echo $newVersion; // 1.5.0

$newVersion = $version->withPatch(9);
echo $newVersion; // 1.0.9

$newVersion = $version->withPreRelease('rc1');
echo $newVersion; // 1.0.0-rc1

$newVersion = $version->withBuildMetadata('build567');
echo $newVersion; // 1.0.0+build567
```

#### Comparing Versions

```php
$version1 = new Version(1, 2, 3);
$version2 = new Version(1, 2, 4);

echo $version1->compare($version2); // -1

$version2 = new Version(1, 3, 0);

echo $version1->compare($version2); // 1

$version2 = new Version(2, 0, 0);

echo $version1->compare($version2); // 0
```

#### Emojis

```php

echo \Napse\StringUtils\Emoji::CHECKMARK_NOK;
// Output: ❌

echo \Napse\StringUtils\Emoji::CHECKMARK_OK;
// Output: ✅
```

## Running Tests

Ensure PHPUnit is installed:

```sh
composer require --dev phpunit/phpunit
```

Run the tests using:

```sh
vendor/bin/phpunit
```

## Contributing

Contributions are welcome! Please open an issue or submit a pull request on GitHub.

## License

This package is licensed under the MIT License.

