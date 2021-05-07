<?php

declare(strict_types=1);

namespace Training\Bundle\UserNamingBundle\Api\Processor\Get;

use Oro\Bundle\ApiBundle\Processor\Get\GetContext;
use Oro\Component\ChainProcessor\ContextInterface;
use Oro\Component\ChainProcessor\ProcessorInterface;
use Training\Bundle\UserNamingBundle\Provider\FullNameProvider;

class NameExampleGetProcessor implements ProcessorInterface
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
        /** @var GetContext $context */

        $result = $context->getResult();

        if (is_array($result)
            && array_key_exists('format', $result)
            && !array_key_exists('nameExample', $result)
        ) {
            $result['nameExample'] = $this->fullNameProvider->getFullNameExample($result['format']);
        }

        $context->setResult($result);
    }
}
