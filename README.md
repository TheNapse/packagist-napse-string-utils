# napse/string-utils

[![Packagist Version](https://img.shields.io/packagist/v/napse/string-utils)](https://packagist.org/packages/napse/string-utils)
[![License](https://img.shields.io/packagist/l/napse/string-utils)](LICENSE)
[![PHP Version](https://img.shields.io/packagist/dependency-v/napse/string-utils/php)](composer.json)

Lightweight string casing conversions and semantic versioning for PHP.

## Installation

```bash
composer require napse/string-utils
```

Requires **PHP 8.2** or higher.

## StringUtils

Converts strings between 12 casing formats:

| Method | Example Output |
|---|---|
| `toFlatCase('Hello World!')` | `helloworld` |
| `toKebabCase('Hello World!')` | `hello-world` |
| `toCamelCase('Hello World!')` | `helloWorld` |
| `toPascalCase('Hello World!')` | `HelloWorld` |
| `toSnakeCase('Hello World!')` | `hello_world` |
| `toConstantCase('Hello World!')` | `HELLO_WORLD` |
| `toCobolCase('Hello World!')` | `HELLO-WORLD` |
| `toTitleCase('Hello World!')` | `Hello World` |
| `toDotCase('Hello World!')` | `hello.world` |
| `toTrainCase('Hello World!')` | `Hello-World` |
| `toSlug('Café & Co!')` | `cafe-co` |
| `toAcronym('Hello World!')` | `HW` |

```php
use Napse\StringUtils\StringUtils;

echo StringUtils::toKebabCase('Hello World! 123');
// Output: hello-world-123

echo StringUtils::toSlug('Über uns! 🎉');
// Output: uber-uns
```

## Version

Immutable semantic versioning value object with parsing, comparison, and modification.

### Creating Versions

```php
use Napse\StringUtils\Version;

$version = new Version(1, 2, 3, 'beta', 'build123');
echo $version; // 1.2.3-beta+build123

$version = Version::fromString('2.1.0-beta+exp.sha.5114f85');
echo $version; // 2.1.0-beta+exp.sha.5114f85
```

### Accessing Components

```php
$version = new Version(1, 2, 3, 'alpha', 'build123');

$version->getMajor();         // 1
$version->getMinor();         // 2
$version->getPatch();         // 3
$version->getPreRelease();    // "alpha"
$version->getBuildMetadata(); // "build123"
```

### Incrementing

```php
$version = new Version(1, 2, 3);

echo $version->incrementMajor(); // 2.0.0
echo $version->incrementMinor(); // 1.3.0
echo $version->incrementPatch(); // 1.2.4
```

### Immutable Modifications

```php
$version = new Version(1, 0, 0);

echo $version->withMajor(2);              // 2.0.0
echo $version->withMinor(5);              // 1.5.0
echo $version->withPatch(9);              // 1.0.9
echo $version->withPreRelease('rc1');     // 1.0.0-rc1
echo $version->withBuildMetadata('b567'); // 1.0.0+b567
```

### Comparing

```php
$v1 = new Version(1, 2, 3);
$v2 = new Version(1, 2, 4);

$v1->compare($v2); // -1 ($v1 < $v2)
$v2->compare($v1); //  1 ($v2 > $v1)

$v3 = new Version(1, 2, 3);
$v1->compare($v3); //  0 ($v1 == $v3)
```

Pre-release versions have lower precedence than the associated normal version (SemVer §11):

```php
$alpha = Version::fromString('1.0.0-alpha');
$stable = new Version(1, 0, 0);

$alpha->compare($stable); // -1 (alpha < stable)
```

### Convenience Methods

```php
$v1 = new Version(1, 0, 0);
$v2 = new Version(2, 0, 0);

$v1->equals($v2);              // false
$v1->lessThan($v2);            // true
$v1->greaterThan($v2);         // false
$v1->lessThanOrEqual($v2);     // true
$v1->greaterThanOrEqual($v2);  // false
$v1->isStable();               // true

$beta = new Version(1, 0, 0, 'beta');
$beta->isStable();             // false
```

## Emoji

Terminal-friendly emoji constants for CLI output.

| Constant | Emoji | Purpose |
|---|---|---|
| `CHECKMARK_OK` | ✅ | Success |
| `CHECKMARK_NOK` | ❌ | Failure |
| `WARNING` | ⚠️ | Warnings |
| `INFO` | ℹ️ | Info messages |
| `ARROW_RIGHT` | ➜ | Lists, steps |
| `ROCKET` | 🚀 | Start/Deploy |
| `HOURGLASS` | ⏳ | In progress |
| `LOCK` | 🔒 | Security/Auth |
| `GEAR` | ⚙️ | Configuration |
| `SPARKLE` | ✨ | Success/New |

```php
use Napse\StringUtils\Emoji;

echo Emoji::CHECKMARK_OK . ' All tests passed';  // ✅ All tests passed
echo Emoji::WARNING . ' Config missing';          // ⚠️ Config missing
echo Emoji::ROCKET . ' Deploying...';             // 🚀 Deploying...
```

## Testing

```bash
composer require --dev phpunit/phpunit
vendor/bin/phpunit
```

## Static Analysis

```bash
composer require --dev phpstan/phpstan
vendor/bin/phpstan analyse
```

## Contributing

Contributions are welcome! Please open an issue or submit a pull request on GitHub.

## License

This package is licensed under the [MIT License](LICENSE).
