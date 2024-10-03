<?php

namespace App\Entity;

use App\Repository\CommandesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandesRepository::class)]
class Commandes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $total = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    /**
     * @var Collection<int, CommandeLines>
     */
    #[ORM\OneToMany(targetEntity: CommandeLines::class, mappedBy: 'commande', orphanRemoval: true)]
    private Collection $commandeLines;

    public function __construct()
    {
        $this->commandeLines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

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
            $commandeLine->setCommande($this);
        }

        return $this;
    }

    public function removeCommandeLine(CommandeLines $commandeLine): static
    {
        if ($this->commandeLines->removeElement($commandeLine)) {
            // set the owning side to null (unless already changed)
            if ($commandeLine->getCommande() === $this) {
                $commandeLine->setCommande(null);
            }
        }

        return $this;
    }
}
