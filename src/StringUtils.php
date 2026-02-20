<?php

declare(strict_types=1);

namespace Napse\StringUtils;

final class StringUtils
{
    private const REGEX_NON_ALPHANUMERIC = '/[^a-zA-Z0-9]+/';

    public static function toFlatCase(string $string): string
    {
        $cleaned = preg_replace(self::REGEX_NON_ALPHANUMERIC, '', $string);

        return strtolower($cleaned ?? '');
    }

    public static function toKebabCase(string $string): string
    {
        $hyphenated = preg_replace(self::REGEX_NON_ALPHANUMERIC, '-', trim($string));

        return rtrim(strtolower($hyphenated ?? ''), '-');
    }

    public static function toCamelCase(string $string): string
    {
        $words = array_values(array_filter(
            preg_split(self::REGEX_NON_ALPHANUMERIC, strtolower($string)) ?: [],
            static fn (string $w): bool => $w !== ''
        ));
        $first = array_shift($words) ?? '';

        return $first . implode('', array_map('ucfirst', $words));
    }

    public static function toPascalCase(string $string): string
    {
        $words = array_filter(
            preg_split(self::REGEX_NON_ALPHANUMERIC, strtolower($string)) ?: [],
            static fn (string $w): bool => $w !== ''
        );

        return implode('', array_map('ucfirst', $words));
    }

    public static function toSnakeCase(string $string): string
    {
        $underscored = preg_replace(self::REGEX_NON_ALPHANUMERIC, '_', trim($string));

        return rtrim(strtolower($underscored ?? ''), '_');
    }

    public static function toConstantCase(string $string): string
    {
        $underscored = preg_replace(self::REGEX_NON_ALPHANUMERIC, '_', trim($string));

        return rtrim(strtoupper($underscored ?? ''), '_');
    }

    public static function toCobolCase(string $string): string
    {
        $hyphenated = preg_replace(self::REGEX_NON_ALPHANUMERIC, '-', trim($string));

        return rtrim(strtoupper($hyphenated ?? ''), '-');
    }

    public static function toTitleCase(string $string): string
    {
        $words = array_filter(
            preg_split(self::REGEX_NON_ALPHANUMERIC, strtolower($string)) ?: [],
            static fn (string $w): bool => $w !== ''
        );

        return implode(' ', array_map('ucfirst', $words));
    }

    public static function toDotCase(string $string): string
    {
        $dotted = preg_replace(self::REGEX_NON_ALPHANUMERIC, '.', trim($string));

        return rtrim(strtolower($dotted ?? ''), '.');
    }

    public static function toTrainCase(string $string): string
    {
        $words = array_filter(
            preg_split(self::REGEX_NON_ALPHANUMERIC, strtolower($string)) ?: [],
            static fn (string $w): bool => $w !== ''
        );

        return implode('-', array_map('ucfirst', $words));
    }

    public static function toSlug(string $string): string
    {
        if (function_exists('transliterator_transliterate')) {
            $transliterated = transliterator_transliterate('Any-Latin; Latin-ASCII; Lower()', $string);
            $string = $transliterated !== false ? $transliterated : strtolower($string);
        } else {
            $converted = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
            $string = $converted !== false ? strtolower($converted) : strtolower($string);
        }

        $slugged = preg_replace(self::REGEX_NON_ALPHANUMERIC, '-', trim($string));

        return trim($slugged ?? '', '-');
    }

    public static function toAcronym(string $string): string
    {
        $words = array_filter(
            preg_split(self::REGEX_NON_ALPHANUMERIC, $string) ?: [],
            static fn (string $w): bool => $w !== ''
        );

        return implode('', array_map(
            static fn (string $w): string => strtoupper($w[0]),
            $words
        ));
    }
}
