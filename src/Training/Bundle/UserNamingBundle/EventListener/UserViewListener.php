<?php

declare(strict_types=1);

namespace Training\Bundle\UserNamingBundle\EventListener;

use Oro\Bundle\UIBundle\Event\BeforeListRenderEvent;
use Oro\Bundle\UserBundle\Entity\User;

class UserViewListener
{
    /**
     * @param BeforeListRenderEvent $event
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function onUserView(BeforeListRenderEvent $event): void
    {
        /** @var User $user */
        $user = $event->getEntity();
        if (!$user) {
            return;
        }

        $template = $event->getEnvironment()->render(
            '@UserNaming/User/namingInfo.html.twig',
            ['entity' => $user]
        );
        $subBlockId = $event->getScrollData()->addSubBlock(0);
        $event->getScrollData()->addSubBlockData(0, $subBlockId, $template);
    }
}
