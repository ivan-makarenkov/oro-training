<?php

declare(strict_types=1);

namespace Training\Bundle\UserNamingBundle\Provider;

use Oro\Bundle\LocaleBundle\Model\FullNameInterface;
use Oro\Bundle\LocaleBundle\Provider\EntityNameProvider as OroEntityNameProvider;

class EntityNameProvider extends OroEntityNameProvider
{
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
        return false;
    }
}
