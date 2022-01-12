<?php

namespace App\Entity;

use App\Repository\PrixProduitRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrixProduitRepository::class)]
class PrixProduit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'float')]
    private $prix;

    #[ORM\Column(type: 'datetime')]
    private $date_application;

    #[ORM\ManyToOne(targetEntity: Produit::class, inversedBy: 'prixProduits')]
    #[ORM\JoinColumn(nullable: false)]
    private $produit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDateApplication(): ?\DateTimeInterface
    {
        return $this->date_application;
    }

    public function setDateApplication(\DateTimeInterface $date_application): self
    {
        $this->date_application = $date_application;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }
}
