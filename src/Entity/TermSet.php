<?php

declare(strict_types=1);

namespace App\Entity;

use Symfony\Component\Uid\Ulid;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity()
 */
class TermSet extends Thing
{
    /**
     * @ORM\Id
     * @ORM\Column(type="ulid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UlidGenerator::class)
     * @Assert\Ulid
     */
    protected Ulid $id;


    /**
     * @ORM\OneToMany(targetEntity=Term::class, mappedBy="termSet")
     * @ApiSubresource(maxDepth=1)
     */
    private Collection $terms;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->terms = new ArrayCollection();
    }

    public function __toString() {
        return $this->getId();
    }

    public function getId(): ?string
    {
        return $this->id->toBase32();
    }

    /**
     * @return Collection|Term[]
     */
    public function getTerms(): Collection
    {
        return $this->terms;
    }

    public function addTerm(Term $term): self
    {
        if (!$this->terms->contains($term)) {
            $this->terms[] = $term;
            $term->setTermSet($this);
        }

        return $this;
    }

    public function removeTerm(Term $term): self
    {
        if ($this->terms->removeElement($term)) {
            // set the owning side to null (unless already changed)
            if ($term->getTermSet() === $this) {
                $term->setTermSet(null);
            }
        }

        return $this;
    }
}
