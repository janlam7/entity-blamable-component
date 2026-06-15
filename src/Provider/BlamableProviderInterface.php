<?php
/**
 * @copyright 2014-present Hostnet B.V.
 */
declare(strict_types=1);

namespace Hostnet\Component\EntityBlamable\Provider;

/**
 * @TODO: add (return)typehints on next BC break, when removing doctrine/annotations
 */
interface BlamableProviderInterface
{
    /**
     * @return string
     */
    public function getUpdatedBy();

    /**
     * @return \DateTime
     */
    public function getChangedAt();
}
