<?php

declare(strict_types=1);

namespace Training\Bundle\UserNamingBundle\Twig;

use Oro\Bundle\UserBundle\Entity\User;
use Training\Bundle\UserNamingBundle\Provider\FullNameProvider;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class UserNamingExtension extends AbstractExtension
{
    private FullNameProvider $fullNameProvider;

    /**
     * @param FullNameProvider $fullNameProvider
     */
    public function __construct(FullNameProvider $fullNameProvider)
    {
        $this->fullNameProvider = $fullNameProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('full_name_example', [$this, 'getFullNameExample'])
        ];
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

        return $this->fullNameProvider->getFullName($user, $format);
    }
}
