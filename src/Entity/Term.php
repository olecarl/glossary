<?php

declare(strict_types=1);

namespace App\Entity;

use Symfony\Component\Uid\Ulid;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Dto\DefinedTerm;

/**
 * @ApiResource(
 *     output=DefinedTerm::class,
 *     attributes={"order"={"name": "ASC"}}
 * )
 * @ORM\Entity()
 */
class Term extends Thing
{


    //<editor-fold desc="Properties">


    /**
     * @ORM\Id
     * @ORM\Column(type="ulid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UlidGenerator::class)
     * @Assert\Ulid
     */
    protected Ulid $id;

    /**
     * @ORM\ManyToOne(targetEntity=TermSet::class, inversedBy="terms")
     */
    private TermSet $termSet;
    //</editor-fold>

    //<editor-fold desc="Getter/Setter">
    public function __toString() {
        return $this->getId();
    }

    public function getId(): ?string
    {
        return $this->id->toBase32();
    }

    public function getTermSet(): ?TermSet
    {
        return $this->termSet;
    }

    public function setTermSet(?TermSet $termSet): self
    {
        $this->termSet = $termSet;

        return $this;
    }

    //</editor-fold>
}
