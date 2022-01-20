<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $prenom;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $adresse;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $ville;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $code_postal;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Commande::class, orphanRemoval: true)]
    private $commandes;

    #[ORM\OneToOne(mappedBy: 'client', targetEntity: Tel::class, cascade: ['persist', 'remove'])]
    private $tel;

    #[ORM\OneToOne(mappedBy: 'client', targetEntity: Email::class, cascade: ['persist', 'remove'])]
    private $email;

    #[ORM\Column(type: 'string', length: 255)]
    private $password;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
    }

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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->code_postal;
    }

    public function setCodePostal(?int $code_postal): self
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setClient($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getClient() === $this) {
                $commande->setClient(null);
            }
        }

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
            $this->tel->setClient(null);
        }

        // set the owning side of the relation if necessary
        if ($tel !== null && $tel->getClient() !== $this) {
            $tel->setClient($this);
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
            $this->email->setClient(null);
        }

        // set the owning side of the relation if necessary
        if ($email !== null && $email->getClient() !== $this) {
            $email->setClient($this);
        }

        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
}
