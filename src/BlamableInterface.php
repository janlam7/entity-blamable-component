<?php
/**
 * @copyright 2014-present Hostnet B.V.
 */
declare(strict_types=1);

namespace Hostnet\Component\EntityBlamable;

/**
 * Implement on Entities to trigger the BlamableEntityListener
 *
 * @TODO: add (return)typehints on next BC break, when removing doctrine/annotations
 */
interface BlamableInterface
{
    /**
     * @param string $by
     */
    public function setUpdatedBy($by);

    /**
     * @param \DateTime $at
     */
    public function setUpdatedAt(\DateTime $at);

    /**
     * @param \DateTime $at
     */
    public function setCreatedAt(\DateTime $at);
}
