<?php

declare(strict_types=1);

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Term;
use App\Repository\TermRepository;

class TermCollectionProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    protected TermRepository $repository;


    public function __construct(TermRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function getCollection(
        string $resourceClass,
        string $operationName = null,
        array $context = []
    ) {
        return $this->repository->findAll() ?? [];
    }

    public function supports(
        string $resourceClass,
        string $operationName = null,
        array $context = []
    ): bool {
        return Term::class === $resourceClass;
    }
}
