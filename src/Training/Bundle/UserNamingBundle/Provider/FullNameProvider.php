<?php

declare(strict_types=1);

namespace Training\Bundle\UserNamingBundle\Provider;

use Oro\Bundle\LocaleBundle\Model\FullNameInterface;

class FullNameProvider
{
    /**
     * @param FullNameInterface $user
     * @param string $format
     * @return string
     */
    public function getFullName(FullNameInterface $user, string $format): string
    {
        return strtr(
            $format,
            [
                'PREFIX' => $user->getNamePrefix(),
                'FIRST' => $user->getFirstName(),
                'MIDDLE' => $user->getMiddleName(),
                'LAST' => $user->getLastName(),
                'SUFFIX' => $user->getNameSuffix(),
            ]
        );
    }
}
