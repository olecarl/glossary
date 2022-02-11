<?php

declare(strict_types=1);

namespace App\Dto;

class DefinedTerm
{


    public string $name;

    public string $description;

    /** @var string|null $image */
    public ?string $image;

    /** @var string|null $url */
    public ?string $url;
}
