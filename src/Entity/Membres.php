<?php

namespace App\Entity;

use App\Repository\MembresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MembresRepository::class)]
class Membres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column]
    private ?float $total = null;

    /**
     * @var Collection<int, MembresPanier>
     */
    #[ORM\OneToMany(targetEntity: MembresPanier::class, mappedBy: 'membre', orphanRemoval: true)]
    private Collection $membresPaniers;

    public function __construct()
    {
        $this->membresPaniers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): static
    {
        $this->total = $total;

        return $this;
    }

    /**
     * @return Collection<int, MembresPanier>
     */
    public function getMembresPaniers(): Collection
    {
        return $this->membresPaniers;
    }

    public function addMembresPanier(MembresPanier $membresPanier): static
    {
        if (!$this->membresPaniers->contains($membresPanier)) {
            $this->membresPaniers->add($membresPanier);
            $membresPanier->setMembre($this);
        }

        return $this;
    }

    public function removeMembresPanier(MembresPanier $membresPanier): static
    {
        if ($this->membresPaniers->removeElement($membresPanier)) {
            // set the owning side to null (unless already changed)
            if ($membresPanier->getMembre() === $this) {
                $membresPanier->setMembre(null);
            }
        }

        return $this;
    }
}
