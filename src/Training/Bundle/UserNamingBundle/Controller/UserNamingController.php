<?php

declare(strict_types=1);

namespace Training\Bundle\UserNamingBundle\Controller;

use Oro\Bundle\SecurityBundle\Annotation\Acl;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Training\Bundle\UserNamingBundle\Entity\UserNamingType;

class UserNamingController
{
    /**
     * @Route("/", name="training_user_naming_index")
     * @Template
     * @AclAncestor("training_user_naming_view")
     *
     * @return array
     */
    public function indexAction(): array
    {
        return [
            'entity_class' => UserNamingType::class,
        ];
    }

    /**
     * @Route("/view/{id}", name="training_user_naming_view", requirements={"id"="\d+"})
     * @Template
     * @Acl(
     *      id="training_user_naming_view",
     *      type="entity",
     *      class="UserNamingBundle:UserNamingType",
     *      permission="VIEW"
     * )
     * @param UserNamingType $type
     * @return array
     */
    public function viewAction(UserNamingType $type): array
    {
        return [
            'entity' => $type,
        ];
    }
}
