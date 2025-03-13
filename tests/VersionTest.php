<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Napse\StringUtils\Version;

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
        $this->assertSame('1.2.3-alpha+build456', (string)$version);
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

    public function testInvalidVersionThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Version::fromString('invalid.version');
    }

    public function testIncrementMethods(): void
    {
        $version = new Version(1, 2, 3);
        $this->assertSame('2.0.0', (string)$version->incrementMajor());
        $this->assertSame('1.3.0', (string)$version->incrementMinor());
        $this->assertSame('1.2.4', (string)$version->incrementPatch());
    }

    public function testCompareTo(): void
    {
        $versionA = new Version(1, 2, 3);
        $versionB = new Version(1, 2, 4);

        var_dump($versionA->compare($versionB));
        $this->assertSame(-1, $versionA->compare($versionB));
        $this->assertSame(1, $versionB->compare($versionA));
    }
}
