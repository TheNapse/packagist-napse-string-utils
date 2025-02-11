<?php

namespace Napse\StringUtils;

class StringUtils
{
    private const string REGEX_NON_ALPHANUMERIC = '/[^a-zA-Z0-9]+/';

    /**
     * Converts a string to flatcase (removes all non-alphanumeric characters and lowercases it).
     *
     * @param string $string
     * @return string
     */
    public static function toFlatCase(string $string): string
    {
        $cleanedString = preg_replace(self::REGEX_NON_ALPHANUMERIC, '', $string); // Remove all non-alphanumeric characters
        return strtolower("$cleanedString"); // Convert to lowercase
    }

    /**
     * Converts a string to kebab-case (replaces non-alphanumeric characters with hyphens and lowercases it).
     *
     * @param string $string
     * @return string
     */
    public static function toKebabCase(string $string): string
    {
        $trimmedString = trim($string); // Trim whitespace
        $hyphenatedString = preg_replace(self::REGEX_NON_ALPHANUMERIC, '-', $trimmedString); // Replace non-alphanumeric characters with hyphens
        return rtrim(strtolower("$hyphenatedString"), '-'); // Convert to lowercase and remove trailing hyphens
    }

    /**
     * Converts a string to camelCase.
     *
     * @param string $string
     * @return string
     */
    public static function toCamelCase(string $string): string
    {
        $lowercaseString = strtolower($string); // Convert to lowercase
        $words = preg_split(self::REGEX_NON_ALPHANUMERIC, $lowercaseString) ?: []; // Split by non-alphanumeric characters
        $firstWord = array_shift($words) ?? ''; // Extract first word (lowercase)
        $capitalizedWords = array_map('ucfirst', $words); // Capitalize remaining words
        return $firstWord . implode('', $capitalizedWords); // Concatenate words
    }

    /**
     * Converts a string to PascalCase.
     *
     * @param string $string
     * @return string
     */
    public static function toPascalCase(string $string): string
    {
        $lowercaseString = strtolower($string); // Convert to lowercase
        $words = preg_split(self::REGEX_NON_ALPHANUMERIC, $lowercaseString) ?: []; // Split by non-alphanumeric characters
        return implode('', array_map('ucfirst', $words)); // Capitalize and join words
    }

    /**
     * Converts a string to snake_case.
     *
     * @param string $string
     * @return string
     */
    public static function toSnakeCase(string $string): string
    {
        $trimmedString = trim($string); // Trim whitespace
        $underscoredString = preg_replace(self::REGEX_NON_ALPHANUMERIC, '_', $trimmedString); // Replace non-alphanumeric characters with underscores
        return rtrim(strtolower("$underscoredString"), '_'); // Convert to lowercase and remove trailing underscores
    }

    /**
     * Converts a string to CONSTANT_CASE.
     *
     * @param string $string
     * @return string
     */
    public static function toConstantCase(string $string): string
    {
        $trimmedString = trim($string); // Trim whitespace
        $underscoredString = preg_replace(self::REGEX_NON_ALPHANUMERIC, '_', $trimmedString); // Replace non-alphanumeric characters with underscores
        return rtrim(strtoupper("$underscoredString"), '_'); // Convert to uppercase and remove trailing underscores
    }

    /**
     * Converts a string to COBOL-CASE.
     *
     * @param string $string
     * @return string
     */
    public static function toCobolCase(string $string): string
    {
        $trimmedString = trim($string); // Trim whitespace
        $hyphenatedString = preg_replace(self::REGEX_NON_ALPHANUMERIC, '-', $trimmedString); // Replace non-alphanumeric characters with hyphens
        return rtrim(strtoupper("$hyphenatedString"), '-'); // Convert to uppercase and remove trailing hyphens
    }
}
