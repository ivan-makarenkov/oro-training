<?php

declare(strict_types=1);

namespace Training\Bundle\UserNamingBundle\Provider;

use Oro\Bundle\LocaleBundle\Model\FullNameInterface;
use Oro\Bundle\UserBundle\Entity\User;

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


    /**
     * @param string $format
     * @return string
     */
    public function getFullNameExample(string $format): string
    {
        $user = new User();
        $user->setNamePrefix('Ms.')
            ->setFirstName('Tes')
            ->setMiddleName('Testovich')
            ->setLastName('Testova')
            ->setNameSuffix('Sx.');

        return $this->getFullName($user, $format);
    }
}
