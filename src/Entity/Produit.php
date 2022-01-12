<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'integer')]
    private $stock;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $description;

    #[ORM\Column(type: 'datetime')]
    private $date_ajout;

    #[ORM\ManyToMany(targetEntity: Categorie::class, mappedBy: 'produit')]
    private $categories;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: PhotoProduit::class, orphanRemoval: true)]
    private $photoProduits;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: PrixProduit::class, orphanRemoval: true)]
    private $prixProduits;

    #[ORM\ManyToMany(targetEntity: Tags::class, mappedBy: 'produit')]
    private $tags;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: ProduitCommande::class, orphanRemoval: true)]
    private $produitCommandes;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->photoProduits = new ArrayCollection();
        $this->prixProduits = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->produitCommandes = new ArrayCollection();
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

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateAjout(): ?\DateTimeInterface
    {
        return $this->date_ajout;
    }

    public function setDateAjout(\DateTimeInterface $date_ajout): self
    {
        $this->date_ajout = $date_ajout;

        return $this;
    }

    /**
     * @return Collection|Categorie[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->addProduit($this);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): self
    {
        if ($this->categories->removeElement($category)) {
            $category->removeProduit($this);
        }

        return $this;
    }

    /**
     * @return Collection|PhotoProduit[]
     */
    public function getPhotoProduits(): Collection
    {
        return $this->photoProduits;
    }

    public function addPhotoProduit(PhotoProduit $photoProduit): self
    {
        if (!$this->photoProduits->contains($photoProduit)) {
            $this->photoProduits[] = $photoProduit;
            $photoProduit->setProduit($this);
        }

        return $this;
    }

    public function removePhotoProduit(PhotoProduit $photoProduit): self
    {
        if ($this->photoProduits->removeElement($photoProduit)) {
            // set the owning side to null (unless already changed)
            if ($photoProduit->getProduit() === $this) {
                $photoProduit->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PrixProduit[]
     */
    public function getPrixProduits(): Collection
    {
        return $this->prixProduits;
    }

    public function addPrixProduit(PrixProduit $prixProduit): self
    {
        if (!$this->prixProduits->contains($prixProduit)) {
            $this->prixProduits[] = $prixProduit;
            $prixProduit->setProduit($this);
        }

        return $this;
    }

    public function removePrixProduit(PrixProduit $prixProduit): self
    {
        if ($this->prixProduits->removeElement($prixProduit)) {
            // set the owning side to null (unless already changed)
            if ($prixProduit->getProduit() === $this) {
                $prixProduit->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Tags[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tags $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
            $tag->addProduit($this);
        }

        return $this;
    }

    public function removeTag(Tags $tag): self
    {
        if ($this->tags->removeElement($tag)) {
            $tag->removeProduit($this);
        }

        return $this;
    }

    /**
     * @return Collection|ProduitCommande[]
     */
    public function getProduitCommandes(): Collection
    {
        return $this->produitCommandes;
    }

    public function addProduitCommande(ProduitCommande $produitCommande): self
    {
        if (!$this->produitCommandes->contains($produitCommande)) {
            $this->produitCommandes[] = $produitCommande;
            $produitCommande->setProduit($this);
        }

        return $this;
    }

    public function removeProduitCommande(ProduitCommande $produitCommande): self
    {
        if ($this->produitCommandes->removeElement($produitCommande)) {
            // set the owning side to null (unless already changed)
            if ($produitCommande->getProduit() === $this) {
                $produitCommande->setProduit(null);
            }
        }

        return $this;
    }
}
