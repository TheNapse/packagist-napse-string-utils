<?php

declare(strict_types=1);

namespace Napse\StringUtils\Tests;

use Napse\StringUtils\StringUtils;
use PHPUnit\Framework\TestCase;

final class StringUtilsTest extends TestCase
{
    private const TEST_CASES = [
        'Hello World!' => [
            'flat' => 'helloworld',
            'kebab' => 'hello-world',
            'camel' => 'helloWorld',
            'pascal' => 'HelloWorld',
            'snake' => 'hello_world',
            'constant' => 'HELLO_WORLD',
            'cobol' => 'HELLO-WORLD',
        ],
        'PHP Unit Testing' => [
            'flat' => 'phpunittesting',
            'kebab' => 'php-unit-testing',
            'camel' => 'phpUnitTesting',
            'pascal' => 'PhpUnitTesting',
            'snake' => 'php_unit_testing',
            'constant' => 'PHP_UNIT_TESTING',
            'cobol' => 'PHP-UNIT-TESTING',
        ],
        'snake_case_example' => [
            'flat' => 'snakecaseexample',
            'kebab' => 'snake-case-example',
            'camel' => 'snakeCaseExample',
            'pascal' => 'SnakeCaseExample',
            'snake' => 'snake_case_example',
            'constant' => 'SNAKE_CASE_EXAMPLE',
            'cobol' => 'SNAKE-CASE-EXAMPLE',
        ],
    ];

    public function testStringTransformations(): void
    {
        foreach (self::TEST_CASES as $input => $expected) {
            $this->assertSame($expected['flat'], StringUtils::toFlatCase($input), "Flat case failed for: $input");
            $this->assertSame($expected['kebab'], StringUtils::toKebabCase($input), "Kebab case failed for: $input");
            $this->assertSame($expected['camel'], StringUtils::toCamelCase($input), "Camel case failed for: $input");
            $this->assertSame($expected['pascal'], StringUtils::toPascalCase($input), "Pascal case failed for: $input");
            $this->assertSame($expected['snake'], StringUtils::toSnakeCase($input), "Snake case failed for: $input");
            $this->assertSame($expected['constant'], StringUtils::toConstantCase($input), "Constant case failed for: $input");
            $this->assertSame($expected['cobol'], StringUtils::toCobolCase($input), "Cobol case failed for: $input");
        }
    }

    public function testEmptyString(): void
    {
        $this->assertSame('', StringUtils::toFlatCase(''));
        $this->assertSame('', StringUtils::toKebabCase(''));
        $this->assertSame('', StringUtils::toCamelCase(''));
        $this->assertSame('', StringUtils::toPascalCase(''));
        $this->assertSame('', StringUtils::toSnakeCase(''));
        $this->assertSame('', StringUtils::toConstantCase(''));
        $this->assertSame('', StringUtils::toCobolCase(''));
    }

    public function testNumericString(): void
    {
        $this->assertSame('123', StringUtils::toFlatCase('123'));
        $this->assertSame('123', StringUtils::toKebabCase('123'));
        $this->assertSame('123', StringUtils::toCamelCase('123'));
        $this->assertSame('123', StringUtils::toPascalCase('123'));
        $this->assertSame('123', StringUtils::toSnakeCase('123'));
        $this->assertSame('123', StringUtils::toConstantCase('123'));
        $this->assertSame('123', StringUtils::toCobolCase('123'));
    }

    public function testSpecialCharactersOnly(): void
    {
        $this->assertSame('', StringUtils::toFlatCase('!@#$'));
        $this->assertSame('', StringUtils::toKebabCase('!@#$'));
        $this->assertSame('', StringUtils::toCamelCase('!@#$'));
        $this->assertSame('', StringUtils::toPascalCase('!@#$'));
        $this->assertSame('', StringUtils::toSnakeCase('!@#$'));
        $this->assertSame('', StringUtils::toConstantCase('!@#$'));
        $this->assertSame('', StringUtils::toCobolCase('!@#$'));
    }

    public function testLeadingTrailingWhitespace(): void
    {
        $this->assertSame('helloworld', StringUtils::toFlatCase('  Hello World  '));
        $this->assertSame('hello-world', StringUtils::toKebabCase('  Hello World  '));
        $this->assertSame('helloWorld', StringUtils::toCamelCase('  Hello World  '));
        $this->assertSame('HelloWorld', StringUtils::toPascalCase('  Hello World  '));
        $this->assertSame('hello_world', StringUtils::toSnakeCase('  Hello World  '));
        $this->assertSame('HELLO_WORLD', StringUtils::toConstantCase('  Hello World  '));
        $this->assertSame('HELLO-WORLD', StringUtils::toCobolCase('  Hello World  '));
    }

    public function testAlreadyFormattedInput(): void
    {
        $this->assertSame('already-kebab', StringUtils::toKebabCase('already-kebab'));
        $this->assertSame('already_snake', StringUtils::toSnakeCase('already_snake'));
        $this->assertSame('alreadyflat', StringUtils::toFlatCase('alreadyflat'));
    }

    public function testTitleCase(): void
    {
        $this->assertSame('Hello World', StringUtils::toTitleCase('Hello World!'));
        $this->assertSame('Php Unit Testing', StringUtils::toTitleCase('PHP Unit Testing'));
        $this->assertSame('Snake Case Example', StringUtils::toTitleCase('snake_case_example'));
        $this->assertSame('', StringUtils::toTitleCase(''));
        $this->assertSame('123', StringUtils::toTitleCase('123'));
        $this->assertSame('', StringUtils::toTitleCase('!@#$'));
    }

    public function testDotCase(): void
    {
        $this->assertSame('hello.world', StringUtils::toDotCase('Hello World!'));
        $this->assertSame('php.unit.testing', StringUtils::toDotCase('PHP Unit Testing'));
        $this->assertSame('snake.case.example', StringUtils::toDotCase('snake_case_example'));
        $this->assertSame('', StringUtils::toDotCase(''));
        $this->assertSame('123', StringUtils::toDotCase('123'));
        $this->assertSame('', StringUtils::toDotCase('!@#$'));
    }

    public function testTrainCase(): void
    {
        $this->assertSame('Hello-World', StringUtils::toTrainCase('Hello World!'));
        $this->assertSame('Php-Unit-Testing', StringUtils::toTrainCase('PHP Unit Testing'));
        $this->assertSame('Snake-Case-Example', StringUtils::toTrainCase('snake_case_example'));
        $this->assertSame('', StringUtils::toTrainCase(''));
        $this->assertSame('123', StringUtils::toTrainCase('123'));
        $this->assertSame('', StringUtils::toTrainCase('!@#$'));
    }

    public function testSlug(): void
    {
        $this->assertSame('hello-world', StringUtils::toSlug('Hello World!'));
        $this->assertSame('uber-uns', StringUtils::toSlug('Über uns'));
        $this->assertSame('cafe', StringUtils::toSlug('Café'));
        $this->assertSame('', StringUtils::toSlug(''));
        $this->assertSame('123', StringUtils::toSlug('123'));
        $this->assertSame('', StringUtils::toSlug('!@#$'));
        $this->assertSame('hello', StringUtils::toSlug('  Hello  '));
    }

    public function testAcronym(): void
    {
        $this->assertSame('HW', StringUtils::toAcronym('Hello World!'));
        $this->assertSame('PUT', StringUtils::toAcronym('PHP Unit Testing'));
        $this->assertSame('SCE', StringUtils::toAcronym('snake_case_example'));
        $this->assertSame('', StringUtils::toAcronym(''));
        $this->assertSame('1', StringUtils::toAcronym('123'));
        $this->assertSame('', StringUtils::toAcronym('!@#$'));
    }
}
