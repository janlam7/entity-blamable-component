<?php
/**
 * @copyright 2026-present Hostnet B.V.
 */
declare(strict_types=1);

namespace Hostnet\Component\EntityBlamable\Listener;

use Hostnet\Component\EntityBlamable\Attributes\Blamable;
use Hostnet\Component\EntityBlamable\BlamableInterface;

#[Blamable]
class EntityWithAttribute implements BlamableInterface
{
    private ?\DateTime $created_at = null;

    private ?string $updated_by    = null;
    private ?\DateTime $updated_at = null;

    public function setUpdatedBy($by): void
    {
        $this->updated_by = $by;
    }

    public function getUpdatedBy(): ?string
    {
        return $this->updated_by;
    }

    public function setUpdatedAt(\DateTime $at): void
    {
        $this->updated_at = $at;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updated_at;
    }

    public function setCreatedAt(\DateTime $at): void
    {
        $this->created_at = $at;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->created_at;
    }
}
