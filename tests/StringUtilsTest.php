<?php

namespace Napse\StringUtils\Tests;

use Napse\StringUtils\StringUtils;
use PHPUnit\Framework\TestCase;

class StringUtilsTest extends TestCase
{
    private const array TEST_CASES = [
        'Hello World!' => [
            'flat' => 'helloworld',
            'kebab' => 'hello-world',
            'camel' => 'helloWorld',
            'pascal' => 'HelloWorld',
            'snake' => 'hello_world',
            'constant' => 'HELLO_WORLD',
            'cobol' => 'HELLO-WORLD'
        ],
        'PHP Unit Testing' => [
            'flat' => 'phpunittesting',
            'kebab' => 'php-unit-testing',
            'camel' => 'phpUnitTesting',
            'pascal' => 'PhpUnitTesting',
            'snake' => 'php_unit_testing',
            'constant' => 'PHP_UNIT_TESTING',
            'cobol' => 'PHP-UNIT-TESTING'
        ],
        'snake_case_example' => [
            'flat' => 'snakecaseexample',
            'kebab' => 'snake-case-example',
            'camel' => 'snakeCaseExample',
            'pascal' => 'SnakeCaseExample',
            'snake' => 'snake_case_example',
            'constant' => 'SNAKE_CASE_EXAMPLE',
            'cobol' => 'SNAKE-CASE-EXAMPLE'
        ]
    ];

    public function testStringTransformationsTest()
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
}
