<?php

declare(strict_types=1);

namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\DefinedTerm;
use App\Entity\Term;

class DefinedTermTransformer implements DataTransformerInterface
{


    /**
     * @inheritDoc
     */
    public function transform($object, string $to, array $context = [])
    {
        $response = new DefinedTerm();
        $response->name = $object->getName();
        $response->description = $object->getDescription();
        $response->url = $object->getUrl();
        $response->image = $object->getImage();

        return $response;
    }

    /**
     * @inheritDoc
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return DefinedTerm::class === $to && $data instanceof Term;
    }
}
