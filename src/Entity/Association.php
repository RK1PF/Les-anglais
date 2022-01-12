<?php

namespace App\Entity;

use App\Repository\AssociationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AssociationRepository::class)]
class Association
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom_contact;

    #[ORM\Column(type: 'string', length: 255)]
    private $prenom_contact;

    #[ORM\OneToOne(mappedBy: 'association', targetEntity: Tel::class, cascade: ['persist', 'remove'])]
    private $tel;

    #[ORM\OneToOne(mappedBy: 'association', targetEntity: Email::class, cascade: ['persist', 'remove'])]
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

    public function getNomContact(): ?string
    {
        return $this->nom_contact;
    }

    public function setNomContact(string $nom_contact): self
    {
        $this->nom_contact = $nom_contact;

        return $this;
    }

    public function getPrenomContact(): ?string
    {
        return $this->prenom_contact;
    }

    public function setPrenomContact(string $prenom_contact): self
    {
        $this->prenom_contact = $prenom_contact;

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
            $this->tel->setAssociation(null);
        }

        // set the owning side of the relation if necessary
        if ($tel !== null && $tel->getAssociation() !== $this) {
            $tel->setAssociation($this);
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
            $this->email->setAssociation(null);
        }

        // set the owning side of the relation if necessary
        if ($email !== null && $email->getAssociation() !== $this) {
            $email->setAssociation($this);
        }

        $this->email = $email;

        return $this;
    }
}
