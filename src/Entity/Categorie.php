<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libCatg;

    /**
     * @ORM\ManyToMany(targetEntity=Livre::class, mappedBy="categories")
     */
    private $livres;

    /**
     * @ORM\ManyToMany(targetEntity=Rayon::class, mappedBy="categories")
     */
    private $rayons;

    public function __construct()
    {
        $this->livres = new ArrayCollection();
        $this->rayons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getLibCatg(): ?string
    {
        return $this->libCatg;
    }

    public function setLibCatg(string $libCatg): self
    {
        $this->libCatg = $libCatg;

        return $this;
    }

    /**
     * @return Collection|Livre[]
     */
    public function getLivres(): Collection
    {
        return $this->livres;
    }

    public function addLivre(Livre $livre): self
    {
        if (!$this->livres->contains($livre)) {
            $this->livres[] = $livre;
            $livre->addCategory($this);
        }

        return $this;
    }

    public function removeLivre(Livre $livre): self
    {
        if ($this->livres->removeElement($livre)) {
            $livre->removeCategory($this);
        }

        return $this;
    }

    /**
     * @return Collection|Rayon[]
     */
    public function getRayons(): Collection
    {
        return $this->rayons;
    }

    public function addRayon(Rayon $rayon): self
    {
        if (!$this->rayons->contains($rayon)) {
            $this->rayons[] = $rayon;
            $rayon->addCategory($this);
        }

        return $this;
    }

    public function removeRayon(Rayon $rayon): self
    {
        if ($this->rayons->removeElement($rayon)) {
            $rayon->removeCategory($this);
        }

        return $this;
    }
}
