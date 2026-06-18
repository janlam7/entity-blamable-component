<?php
/**
 * @copyright 2014-present Hostnet B.V.
 */
declare(strict_types=1);

namespace Hostnet\Component\EntityBlamable;

use Hostnet\Component\EntityTracker\Annotation\Tracked;

/**
 * @Annotation
 * @Target({"CLASS"})
 *
 * @deprecated Please use the attribute instead
 */
class Blamable extends Tracked
{
}
