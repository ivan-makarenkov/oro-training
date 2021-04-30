<?php

declare(strict_types=1);

namespace Training\Bundle\UserNamingBundle;

use Training\Bundle\UserNamingBundle\DependencyInjection\Compiler\EntityNameProviderPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class UserNamingBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->addCompilerPass(new EntityNameProviderPass());
    }
}
