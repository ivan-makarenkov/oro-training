<?php

declare(strict_types=1);

namespace Training\Bundle\UserNamingBundle\Provider;

use Oro\Bundle\EntityBundle\Provider\EntityNameProviderInterface;
use Oro\Bundle\LocaleBundle\Model\FullNameInterface;

class EntityNameProviderDecorator implements EntityNameProviderInterface
{
    protected EntityNameProviderInterface $entityNameProvider;

    public function __construct(EntityNameProviderInterface $entityNameProvider)
    {
        $this->entityNameProvider = $entityNameProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function getName($format, $locale, $entity)
    {
        if ($entity instanceof FullNameInterface) {
            return sprintf(
                '%s %s %s',
                $entity->getLastName(),
                $entity->getFirstName(),
                $entity->getMiddleName()
            );
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
