<?php

namespace App\Entity;

use App\Repository\MembresPanierRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MembresPanierRepository::class)]
class MembresPanier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'membresPaniers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Membres $membre = null;

    #[ORM\ManyToOne(inversedBy: 'membresPaniers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produits $produit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMembre(): ?Membres
    {
        return $this->membre;
    }

    public function setMembre(?Membres $membre): static
    {
        $this->membre = $membre;

        return $this;
    }

    public function getProduit(): ?Produits
    {
        return $this->produit;
    }

    public function setProduit(?Produits $produit): static
    {
        $this->produit = $produit;

        return $this;
    }
}
