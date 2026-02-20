<?php

declare(strict_types=1);

namespace Napse\StringUtils\Tests;

use Napse\StringUtils\Emoji;
use PHPUnit\Framework\TestCase;

final class EmojiTest extends TestCase
{
    public function testConstantsExist(): void
    {
        $this->assertNotEmpty(Emoji::CHECKMARK_OK);
        $this->assertNotEmpty(Emoji::CHECKMARK_NOK);
        $this->assertNotEmpty(Emoji::WARNING);
        $this->assertNotEmpty(Emoji::INFO);
        $this->assertNotEmpty(Emoji::ARROW_RIGHT);
        $this->assertNotEmpty(Emoji::ROCKET);
        $this->assertNotEmpty(Emoji::HOURGLASS);
        $this->assertNotEmpty(Emoji::LOCK);
        $this->assertNotEmpty(Emoji::GEAR);
        $this->assertNotEmpty(Emoji::SPARKLE);
    }
}
