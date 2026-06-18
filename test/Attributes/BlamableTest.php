<?php
/**
 * @copyright 2026-present Hostnet B.V.
 */
declare(strict_types=1);

namespace Hostnet\Component\EntityBlamable\Attributes;

use Hostnet\Component\EntityTracker\Attributes\Tracked;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Hostnet\Component\EntityBlamable\Attributes\Blamable
 */
class BlamableTest extends TestCase
{
    public function test(): void
    {
        $blamable = new Blamable();

        self::assertInstanceOf(Tracked::class, $blamable);
    }
}
