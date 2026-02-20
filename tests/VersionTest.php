<?php

declare(strict_types=1);

namespace Napse\StringUtils\Tests;

use InvalidArgumentException;
use Napse\StringUtils\Version;
use PHPUnit\Framework\TestCase;

final class VersionTest extends TestCase
{
    public function testDefaultVersion(): void
    {
        $version = new Version();
        $this->assertSame(1, $version->getMajor());
        $this->assertSame(0, $version->getMinor());
        $this->assertSame(0, $version->getPatch());
        $this->assertNull($version->getPreRelease());
        $this->assertNull($version->getBuildMetadata());
    }

    public function testVersionWithCustomValues(): void
    {
        $version = new Version(2, 3, 4, 'beta', 'build123');
        $this->assertSame(2, $version->getMajor());
        $this->assertSame(3, $version->getMinor());
        $this->assertSame(4, $version->getPatch());
        $this->assertSame('beta', $version->getPreRelease());
        $this->assertSame('build123', $version->getBuildMetadata());
    }

    public function testToString(): void
    {
        $version = new Version(1, 2, 3, 'alpha', 'build456');
        $this->assertSame('1.2.3-alpha+build456', (string) $version);
    }

    public function testToStringWithoutOptionalParts(): void
    {
        $version = new Version(1, 0, 0);
        $this->assertSame('1.0.0', (string) $version);
    }

    public function testFromString(): void
    {
        $version = Version::fromString('2.1.0-beta+exp.sha.5114f85');
        $this->assertSame(2, $version->getMajor());
        $this->assertSame(1, $version->getMinor());
        $this->assertSame(0, $version->getPatch());
        $this->assertSame('beta', $version->getPreRelease());
        $this->assertSame('exp.sha.5114f85', $version->getBuildMetadata());
    }

    public function testFromStringWithoutPatch(): void
    {
        $version = Version::fromString('1.2');
        $this->assertSame(1, $version->getMajor());
        $this->assertSame(2, $version->getMinor());
        $this->assertSame(0, $version->getPatch());
    }

    public function testFromStringNumeric(): void
    {
        $version = Version::fromString('3');
        $this->assertSame(3, $version->getMajor());
        $this->assertSame(0, $version->getMinor());
        $this->assertSame(0, $version->getPatch());
    }

    public function testInvalidVersionThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Version::fromString('invalid.version');
    }

    public function testNegativeVersionThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Version(-1, 0, 0);
    }

    public function testInvalidPreReleaseThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Version(1, 0, 0, 'invalid format!');
    }

    public function testInvalidBuildMetadataThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Version(1, 0, 0, null, 'invalid format!');
    }

    public function testIncrementMethods(): void
    {
        $version = new Version(1, 2, 3);
        $this->assertSame('2.0.0', (string) $version->incrementMajor());
        $this->assertSame('1.3.0', (string) $version->incrementMinor());
        $this->assertSame('1.2.4', (string) $version->incrementPatch());
    }

    public function testWithMethods(): void
    {
        $version = new Version(1, 2, 3);

        $this->assertSame('5.2.3', (string) $version->withMajor(5));
        $this->assertSame('1.9.3', (string) $version->withMinor(9));
        $this->assertSame('1.2.7', (string) $version->withPatch(7));
        $this->assertSame('1.2.3-rc1', (string) $version->withPreRelease('rc1'));
        $this->assertSame('1.2.3+build789', (string) $version->withBuildMetadata('build789'));
    }

    public function testWithMethodsReturnNewInstance(): void
    {
        $original = new Version(1, 0, 0);
        $modified = $original->withMajor(2);

        $this->assertSame('1.0.0', (string) $original);
        $this->assertSame('2.0.0', (string) $modified);
    }

    public function testCompare(): void
    {
        $v1 = new Version(1, 2, 3);
        $v2 = new Version(1, 2, 4);

        $this->assertSame(-1, $v1->compare($v2));
        $this->assertSame(1, $v2->compare($v1));
    }

    public function testCompareEqual(): void
    {
        $v1 = new Version(1, 2, 3);
        $v2 = new Version(1, 2, 3);

        $this->assertSame(0, $v1->compare($v2));
    }

    public function testCompareMajorDifference(): void
    {
        $v1 = new Version(1, 9, 9);
        $v2 = new Version(2, 0, 0);

        $this->assertSame(-1, $v1->compare($v2));
    }
}
