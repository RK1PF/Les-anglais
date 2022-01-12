<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: ProduitCommande::class, orphanRemoval: true)]
    private $produitCommande;

    #[ORM\Column(type: 'datetime')]
    private $date_creation;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    private $client;

    public function __construct()
    {
        $this->produitCommande = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|ProduitCommande[]
     */
    public function getProduitCommande(): Collection
    {
        return $this->produitCommande;
    }

    public function addProduitCommande(ProduitCommande $produitCommande): self
    {
        if (!$this->produitCommande->contains($produitCommande)) {
            $this->produitCommande[] = $produitCommande;
            $produitCommande->setCommande($this);
        }

        return $this;
    }

    public function removeProduitCommande(ProduitCommande $produitCommande): self
    {
        if ($this->produitCommande->removeElement($produitCommande)) {
            // set the owning side to null (unless already changed)
            if ($produitCommande->getCommande() === $this) {
                $produitCommande->setCommande(null);
            }
        }

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }
}
