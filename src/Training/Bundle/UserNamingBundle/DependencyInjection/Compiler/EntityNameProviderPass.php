<?php

declare(strict_types=1);

namespace Training\Bundle\UserNamingBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Training\Bundle\UserNamingBundle\Provider\EntityNameProvider;

class EntityNameProviderPass implements CompilerPassInterface
{
    const REGISTRY_SERVICE = 'oro_locale.entity_name_provider';

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition(self::REGISTRY_SERVICE)) {
            return;
        }

        $registryDefinition = $container->getDefinition(self::REGISTRY_SERVICE);
        $registryDefinition->setClass(EntityNameProvider::class);
    }
}
