<?php

namespace App\Entity;

use App\Repository\TelRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TelRepository::class)]
class Tel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'bigint')]
    private $num;

    #[ORM\OneToOne(inversedBy: 'tel', targetEntity: Client::class, cascade: ['persist', 'remove'])]
    private $client;

    #[ORM\OneToOne(inversedBy: 'tel', targetEntity: Association::class, cascade: ['persist', 'remove'])]
    private $association;

    #[ORM\OneToOne(inversedBy: 'tel', targetEntity: Vendeur::class, cascade: ['persist', 'remove'])]
    private $vendeur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNum(): ?string
    {
        return $this->num;
    }

    public function setNum(string $num): self
    {
        $this->num = $num;

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

    public function getAssociation(): ?Association
    {
        return $this->association;
    }

    public function setAssociation(?Association $association): self
    {
        $this->association = $association;

        return $this;
    }

    public function getVendeur(): ?Vendeur
    {
        return $this->vendeur;
    }

    public function setVendeur(?Vendeur $vendeur): self
    {
        $this->vendeur = $vendeur;

        return $this;
    }
}
