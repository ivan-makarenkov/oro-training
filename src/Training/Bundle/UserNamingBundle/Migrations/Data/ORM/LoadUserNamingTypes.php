<?php

declare(strict_types=1);

namespace Training\Bundle\UserNamingBundle\Migrations\Data\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Persistence\ObjectManager;
use Training\Bundle\UserNamingBundle\Entity\UserNamingType;

class LoadUserNamingTypes extends AbstractFixture
{
    private array $namingTypes = [
        'Official'         => 'PREFIX FIRST MIDDLE LAST SUFFIX',
        'Unofficial'       => 'FIRST LAST',
        'First name only'  => 'FIRST'
    ];

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        foreach ($this->namingTypes as $title => $format) {
            $type = new UserNamingType();
            $type->setTitle($title);
            $type->setFormat($format);

            $manager->persist($type);
        }

        $manager->flush();
    }
}