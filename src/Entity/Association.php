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
    private $nomContact;
    // private $nom_contact;

    #[ORM\Column(type: 'string', length: 255)]
    private $prenomContact;
    // private $prenom_contact;

    #[ORM\Column(type: 'bigint')]
    private $tel;

    #[ORM\Column(type: 'string', length: 255)]
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
        return $this->nomContact;
        // return $this->nom_contact;
    }

    public function setNomContact(string $nomContact): self
    {
        $this->nomContact = $nomContact;
        // $this->nom_contact = $nom_contact;

        return $this;
    }

    public function getPrenomContact(): ?string
    {
        return $this->prenomContact;
        // return $this->prenom_contact;
    }

    public function setPrenomContact(string $prenomContact): self
    {
        $this->prenomContact = $prenomContact;
        // $this->prenom_contact = $prenom_contact;
        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }



}
