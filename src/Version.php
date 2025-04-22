<?php

declare(strict_types=1);

namespace Napse\StringUtils;
final class Version
{
    public function __construct(
        private readonly int     $major = 1,
        private readonly int     $minor = 0,
        private readonly int     $patch = 0,
        private readonly ?string $preRelease = null,
        private readonly ?string $buildMetadata = null
    )
    {
        $this->validate();
    }

    public function getMajor(): int
    {
        return $this->major;
    }

    public function getMinor(): int
    {
        return $this->minor;
    }

    public function getPatch(): int
    {
        return $this->patch;
    }

    public function getPreRelease(): ?string
    {
        return $this->preRelease;
    }

    public function getBuildMetadata(): ?string
    {
        return $this->buildMetadata;
    }

    public function withMajor(int $major): self
    {
        return new self($major, $this->minor, $this->patch, $this->preRelease, $this->buildMetadata);
    }

    public function withMinor(int $minor): self
    {
        return new self($this->major, $minor, $this->patch, $this->preRelease, $this->buildMetadata);
    }

    public function withPatch(int $patch): self
    {
        return new self($this->major, $this->minor, $patch, $this->preRelease, $this->buildMetadata);
    }

    public function withPreRelease(?string $preRelease): self
    {
        return new self($this->major, $this->minor, $this->patch, $preRelease, $this->buildMetadata);
    }

    public function withBuildMetadata(?string $buildMetadata): self
    {
        return new self($this->major, $this->minor, $this->patch, $this->preRelease, $buildMetadata);
    }

    public function incrementMajor(): self
    {
        return new self($this->major + 1, 0, 0);
    }

    public function incrementMinor(): self
    {
        return new self($this->major, $this->minor + 1, 0);
    }

    public function incrementPatch(): self
    {
        return new self($this->major, $this->minor, $this->patch + 1);
    }

    /**
     * @param Version $versionB
     * @return int -1 if $this < $versionB, 0 if $this == $versionB, 1 if $this > $versionB
     */
    public function compare(Version $versionB): int
    {
        return $this->major <=> $versionB->major
            ?: $this->minor <=> $versionB->minor
                ?: $this->patch <=> $versionB->patch;
    }

    public function __toString(): string
    {
        $version = "{$this->major}.{$this->minor}.{$this->patch}";

        if ($this->preRelease) {
            $version .= "-{$this->preRelease}";
        }

        if ($this->buildMetadata) {
            $version .= "+{$this->buildMetadata}";
        }

        return $version;
    }

    public static function fromString(string $version): self
    {
        $pattern = '/^(0|[1-9]\d*)\.(0|[1-9]\d*)(?:\.(0|[1-9]\d*))?(?:-([\da-zA-Z.-]+))?(?:\+([\da-zA-Z.-]+))?$/';

        if (!preg_match($pattern, $version, $matches)) {

            if (is_numeric($version)) {
                return new self(
                    (int)$version
                );
            }

            throw new \InvalidArgumentException("Invalid version format: {$version}");
        }

        return new self(
            (int)$matches[1],
            (int)$matches[2],
            isset($matches[3]) ? (int)$matches[3] : 0,
            $matches[4] ?? null,
            $matches[5] ?? null
        );
    }

    private function validate(): void
    {
        if ($this->major < 0 || $this->minor < 0 || $this->patch < 0) {
            throw new \InvalidArgumentException("Version numbers must be non-negative.");
        }

        if ($this->preRelease && !preg_match('/^[0-9A-Za-z-]+(\.[0-9A-Za-z-]+)*$/', $this->preRelease)) {
            throw new \InvalidArgumentException("Invalid pre-release format.");
        }

        if ($this->buildMetadata && !preg_match('/^[0-9A-Za-z-]+(\.[0-9A-Za-z-]+)*$/', $this->buildMetadata)) {
            throw new \InvalidArgumentException("Invalid build metadata format.");
        }
    }
}
