<?php

declare(strict_types=1);

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Term;
use App\Repository\TermRepository;

final class TermProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    protected TermRepository $repository;


    public function __construct(TermRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @inheritDoc
     */
    public function getItem(
        string $resourceClass,
        $id,
        string $operationName = null,
        array $context = []
    ) : ?Term {
        return $this->repository->find($id) ?? null;
    }

    public function supports(
        string $resourceClass,
        string $operationName = null,
        array $context = []
    ): bool {
        return Term::class === $resourceClass;
    }
}
