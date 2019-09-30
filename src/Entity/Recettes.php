<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RecettesRepository")
 */
class Recettes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="integer")
     */
    private $TempsPreparation;

    /**
     * @ORM\Column(type="integer")
     */
    private $TempsCuisson;

    /**
     * @ORM\Column(type="integer")
     */
    private $Prix;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Etapes", mappedBy="recette")
     */
    private $etapes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ustensiles", mappedBy="recettes")
     */
    private $ustensiles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Avis", mappedBy="recette")
     */
    private $avis;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Categorie", mappedBy="recettes")
     */
    private $categories;

    public function __construct()
    {
        $this->etapes = new ArrayCollection();
        $this->ustensiles = new ArrayCollection();
        $this->avis = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getTempsPreparation(): ?int
    {
        return $this->TempsPreparation;
    }

    public function setTempsPreparation(int $TempsPreparation): self
    {
        $this->TempsPreparation = $TempsPreparation;

        return $this;
    }

    public function getTempsCuisson(): ?int
    {
        return $this->TempsCuisson;
    }

    public function setTempsCuisson(int $TempsCuisson): self
    {
        $this->TempsCuisson = $TempsCuisson;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->Prix;
    }

    public function setPrix(int $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }

    /**
     * @return Collection|Etapes[]
     */
    public function getEtapes(): Collection
    {
        return $this->etapes;
    }

    public function addEtape(Etapes $etape): self
    {
        if (!$this->etapes->contains($etape)) {
            $this->etapes[] = $etape;
            $etape->setRecette($this);
        }

        return $this;
    }

    public function removeEtape(Etapes $etape): self
    {
        if ($this->etapes->contains($etape)) {
            $this->etapes->removeElement($etape);
            // set the owning side to null (unless already changed)
            if ($etape->getRecette() === $this) {
                $etape->setRecette(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Ustensiles[]
     */
    public function getUstensiles(): Collection
    {
        return $this->ustensiles;
    }

    public function addUstensile(Ustensiles $ustensile): self
    {
        if (!$this->ustensiles->contains($ustensile)) {
            $this->ustensiles[] = $ustensile;
            $ustensile->addRecette($this);
        }

        return $this;
    }

    public function removeUstensile(Ustensiles $ustensile): self
    {
        if ($this->ustensiles->contains($ustensile)) {
            $this->ustensiles->removeElement($ustensile);
            $ustensile->removeRecette($this);
        }

        return $this;
    }

    /**
     * @return Collection|Avis[]
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvi(Avis $avi): self
    {
        if (!$this->avis->contains($avi)) {
            $this->avis[] = $avi;
            $avi->setRecette($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avi): self
    {
        if ($this->avis->contains($avi)) {
            $this->avis->removeElement($avi);
            // set the owning side to null (unless already changed)
            if ($avi->getRecette() === $this) {
                $avi->setRecette(null);
            }
        }

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
            $category->addRecette($this);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
            $category->removeRecette($this);
        }

        return $this;
    }
}
