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

### Contributing

Feel free to fork the repository, create a feature branch for your changes, and submit a PR.

### License

This project is licensed under the Apache-2.0 License.
