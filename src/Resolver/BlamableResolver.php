<?php
/**
 * @copyright 2014-present Hostnet B.V.
 */
declare(strict_types=1);

namespace Hostnet\Component\EntityBlamable\Resolver;

use Doctrine\ORM\EntityManagerInterface;
use Hostnet\Component\EntityBlamable\Attributes\Blamable;
use Hostnet\Component\EntityBlamable\Blamable as BlamabeAnnotation;
use Hostnet\Component\EntityTracker\Provider\EntityAnnotationMetadataProvider;

class BlamableResolver implements BlamableResolverInterface
{
    /**
     * @var EntityAnnotationMetadataProvider
     */
    private $provider;

    /**
     * @param EntityAnnotationMetadataProvider $provider
     */
    public function __construct(EntityAnnotationMetadataProvider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * @see \Hostnet\Component\EntityBlamable\Resolver\BlamableResolverInterface::getBlamableAnnotation()
     *
     * @deprecated Please use the attribute instead.
     */
    public function getBlamableAnnotation(EntityManagerInterface $em, $entity)
    {
        return $this->provider->getAnnotationFromEntity($em, $entity, BlamabeAnnotation::class);
    }

    public function getBlamableAttribute(EntityManagerInterface $em, $entity): ?Blamable
    {
        return $this->provider->getAttributeFromEntity(Blamable::class, $em, $entity);
    }
}
