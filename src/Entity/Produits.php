<?php

namespace App\Entity;

use App\Repository\ProduitsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitsRepository::class)]
class Produits
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $designation = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Type $type = null;

    #[ORM\Column(nullable: true)]
    private ?int $stock = null;

    /**
     * @var Collection<int, CommandeLines>
     */
    #[ORM\OneToMany(targetEntity: CommandeLines::class, mappedBy: 'produit', orphanRemoval: true)]
    private Collection $commandeLines;

    /**
     * @var Collection<int, MembresPanier>
     */
    #[ORM\OneToMany(targetEntity: MembresPanier::class, mappedBy: 'produit', orphanRemoval: true)]
    private Collection $membresPaniers;

    public function __construct()
    {
        $this->commandeLines = new ArrayCollection();
        $this->membresPaniers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): static
    {
        $this->designation = $designation;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(?int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * @return Collection<int, CommandeLines>
     */
    public function getCommandeLines(): Collection
    {
        return $this->commandeLines;
    }

    public function addCommandeLine(CommandeLines $commandeLine): static
    {
        if (!$this->commandeLines->contains($commandeLine)) {
            $this->commandeLines->add($commandeLine);
            $commandeLine->setProduit($this);
        }

        return $this;
    }

    public function removeCommandeLine(CommandeLines $commandeLine): static
    {
        if ($this->commandeLines->removeElement($commandeLine)) {
            // set the owning side to null (unless already changed)
            if ($commandeLine->getProduit() === $this) {
                $commandeLine->setProduit(null);
            }
        }

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
            $membresPanier->setProduit($this);
        }

        return $this;
    }

    public function removeMembresPanier(MembresPanier $membresPanier): static
    {
        if ($this->membresPaniers->removeElement($membresPanier)) {
            // set the owning side to null (unless already changed)
            if ($membresPanier->getProduit() === $this) {
                $membresPanier->setProduit(null);
            }
        }

        return $this;
    }
}
