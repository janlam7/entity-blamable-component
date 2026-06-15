<?php
/**
 * @copyright 2014-present Hostnet B.V.
 */
declare(strict_types=1);

namespace Hostnet\Component\EntityBlamable\Listener;

use Hostnet\Component\EntityBlamable\Attributes\Blamable;
use Hostnet\Component\EntityBlamable\BlamableInterface;
use Hostnet\Component\EntityBlamable\Provider\BlamableProviderInterface;
use Hostnet\Component\EntityBlamable\Resolver\BlamableResolverInterface;
use Hostnet\Component\EntityTracker\Event\EntityChangedEvent;

/**
 * Listens to "Events::entityChanged"
 *
 * Attempts to set updated at, created at, updated by and updated at fields
 * in an entity using @Blamable and implementing the BlamableInterface
 */
class BlamableListener
{
    /**
     * @var BlamableResolverInterface
     */
    private $resolver;

    /**
     * @var BlamableProviderInterface
     */
    private $provider;

    /**
     * Caches the class names to prevent iterating over attribute and annotations again on the next entity.
     */
    private array $is_blamable_cache = [];

    /**
     * @param BlamableResolverInterface $resolver
     * @param BlamableProviderInterface $provider
     */
    public function __construct(
        BlamableResolverInterface $resolver,
        BlamableProviderInterface $provider
    ) {
        $this->resolver = $resolver;
        $this->provider = $provider;
    }

    /**
     * @param EntityChangedEvent $event
     */
    public function entityChanged(EntityChangedEvent $event): void
    {
        $entity = $event->getCurrentEntity();

        if (!$this->isBlamable($event->getEntityManager(), $entity)) {
            return;
        }

        $changed_at = $this->provider->getChangedAt();
        $updated_by = $this->provider->getUpdatedBy();

        $entity->setUpdatedBy($updated_by);
        $entity->setUpdatedAt($changed_at);

        if (null === $event->getOriginalEntity()) {
            // new entity, also fill in created at
            $entity->setCreatedAt($changed_at);
        }
    }

    private function isBlamable($em, $entity): bool
    {
        $class = get_class($entity);
        if (array_key_exists($class, $this->is_blamable_cache)) {
            return $this->is_blamable_cache[$class];
        }

        if (!($entity instanceof BlamableInterface)) {
            $this->is_blamable_cache[$class] = false;

            return false;
        }

        if (null !== $this->resolver->getBlamableAnnotation($em, $entity)) {
            $this->is_blamable_cache[$class] = true;

            return true;
        }

        if ($this->hasBlamableAttribute($entity)) {
            $this->is_blamable_cache[$class] = true;

            return true;
        }

        $this->is_blamable_cache[$class] = false;

        return false;
    }

    private function hasBlamableAttribute($entity): bool
    {
        $reflection = new \ReflectionClass($entity);
        $attributes = $reflection->getAttributes(Blamable::class);

        return !empty($attributes);
    }
}
