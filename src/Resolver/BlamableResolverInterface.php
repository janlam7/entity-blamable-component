<?php
/**
 * @copyright 2014-present Hostnet B.V.
 */
declare(strict_types=1);

namespace Hostnet\Component\EntityBlamable\Resolver;

use Doctrine\ORM\EntityManagerInterface;
use Hostnet\Component\EntityBlamable\Blamable;

interface BlamableResolverInterface
{
    /**
     * Return the blamable annotation
     *
     * @param  EntityManagerInterface $em
     * @param  mixed                  $entity
     * @return Blamable
     *
     * @deprecated Please use the attribute instead.
     */
    public function getBlamableAnnotation(EntityManagerInterface $em, $entity);
}
