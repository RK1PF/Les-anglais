<?php

namespace App\Entity;

use App\Repository\VendeurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VendeurRepository::class)]
class Vendeur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $prenom;

    #[ORM\Column(type: 'string', length: 255)]
    private $motdepasse;

    #[ORM\Column(type: 'datetime')]
    private $date_inscription;

    #[ORM\OneToOne(inversedBy: 'vendeur', targetEntity: Commerce::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $commerce;

    #[ORM\OneToOne(mappedBy: 'vendeur', targetEntity: Tel::class, cascade: ['persist', 'remove'])]
    private $tel;

    #[ORM\OneToOne(mappedBy: 'vendeur', targetEntity: Email::class, cascade: ['persist', 'remove'])]
    private $email;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getMotdepasse(): ?string
    {
        return $this->motdepasse;
    }

    public function setMotdepasse(string $motdepasse): self
    {
        $this->motdepasse = $motdepasse;

        return $this;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->date_inscription;
    }

    public function setDateInscription(\DateTimeInterface $date_inscription): self
    {
        $this->date_inscription = $date_inscription;

        return $this;
    }

    public function getCommerce(): ?Commerce
    {
        return $this->commerce;
    }

    public function setCommerce(Commerce $commerce): self
    {
        $this->commerce = $commerce;

        return $this;
    }

    public function getTel(): ?Tel
    {
        return $this->tel;
    }

    public function setTel(?Tel $tel): self
    {
        // unset the owning side of the relation if necessary
        if ($tel === null && $this->tel !== null) {
            $this->tel->setVendeur(null);
        }

        // set the owning side of the relation if necessary
        if ($tel !== null && $tel->getVendeur() !== $this) {
            $tel->setVendeur($this);
        }

        $this->tel = $tel;

        return $this;
    }

    public function getEmail(): ?Email
    {
        return $this->email;
    }

    public function setEmail(?Email $email): self
    {
        // unset the owning side of the relation if necessary
        if ($email === null && $this->email !== null) {
            $this->email->setVendeur(null);
        }

        // set the owning side of the relation if necessary
        if ($email !== null && $email->getVendeur() !== $this) {
            $email->setVendeur($this);
        }

        $this->email = $email;

        return $this;
    }
}
