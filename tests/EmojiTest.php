<?php

declare(strict_types=1);

namespace Napse\StringUtils\Tests;

use Napse\StringUtils\Emoji;
use PHPUnit\Framework\TestCase;

final class EmojiTest extends TestCase
{
    public function testConstantsExist(): void
    {
        $this->assertNotEmpty(Emoji::HEART);
        $this->assertNotEmpty(Emoji::EYES);
        $this->assertNotEmpty(Emoji::GRINNING);
        $this->assertNotEmpty(Emoji::CHECKMARK_OK);
        $this->assertNotEmpty(Emoji::CHECKMARK_NOK);
    }
}
