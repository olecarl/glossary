<?php

declare(strict_types=1);

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass()
 */
class Thing
{


    //<editor-fold desc="Properties">


    /**
     * @ORM\Column(type="string", length=64)
     * @Assert\NotBlank()
     */
    protected string $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    protected string $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected ?string $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected ?string $url;

    //</editor-fold>

    //<editor-fold desc="Getter/Setter">


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    //</editor-fold>
}
