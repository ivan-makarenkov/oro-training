<?php

declare(strict_types=1);

namespace Training\Bundle\UserNamingBundle\Api\Processor\GetList;

use Oro\Bundle\ApiBundle\Processor\Get\GetContext;
use Oro\Bundle\ApiBundle\Processor\GetList\GetListContext;
use Oro\Component\ChainProcessor\ContextInterface;
use Oro\Component\ChainProcessor\ProcessorInterface;
use Training\Bundle\UserNamingBundle\Provider\FullNameProvider;

class NameExampleGetListProcessor implements ProcessorInterface
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
    public function process(ContextInterface $context): void
    {
        /** @var GetContext|GetListContext $context */
        $result = $context->getResult();

        if (is_array($result)) {
            foreach ($result as $key => $entityData) {
                if (array_key_exists('format', $entityData) &&
                    !array_key_exists('nameExample', $entityData)
                ) {
                    $result[$key]['nameExample'] = $this->fullNameProvider->getFullNameExample($entityData['format']);
                }
            }
        }

        $context->setResult($result);
    }
}
