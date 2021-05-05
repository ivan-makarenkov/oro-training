<?php

declare(strict_types=1);

namespace Training\Bundle\UserNamingBundle\Provider;

use Oro\Bundle\EntityBundle\Provider\EntityNameProviderInterface;
use Oro\Bundle\UserBundle\Entity\User;
use Training\Bundle\UserNamingBundle\Entity\UserNamingType;

class EntityNameProviderDecorator implements EntityNameProviderInterface
{
    protected EntityNameProviderInterface $entityNameProvider;

    protected FullNameProvider $fullNameProvider;

    public function __construct(
        EntityNameProviderInterface $entityNameProvider,
        FullNameProvider $fullNameProvider
    ) {
        $this->entityNameProvider = $entityNameProvider;
        $this->fullNameProvider = $fullNameProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function getName($format, $locale, $entity)
    {
        if ($entity instanceof User) {
            /** @var UserNamingType|null $namingType */
            $namingType = $entity->getNamingType();
            if ($namingType) {
                return $this->fullNameProvider->getFullName($entity, $namingType->getFormat());
            }
        }

        return $this->entityNameProvider->getName($format, $locale, $entity);
    }

    /**
     * {@inheritdoc}
     */
    public function getNameDQL($format, $locale, $className, $alias)
    {
        return $this->entityNameProvider->getNameDQL($format, $locale, $className, $alias);
    }
}
