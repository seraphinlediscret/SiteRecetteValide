<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IngredientsRepository")
 */
class Ingredients
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
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Unity", inversedBy="ingredient")
     */
    private $unity;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Recipes", mappedBy="ingredient")
     */
    private $recipes;

    public function __construct()
    {
        $this->ingredient = new ArrayCollection();
        $this->recipes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getUnity(): ?Unity
    {
        return $this->unity;
    }

    public function setUnity(?Unity $unity): self
    {
        $this->unity = $unity;

        return $this;
    }
  
    

     /**
      * @return Collection|Recipes[]
      */
     public function getRecipes(): Collection
     {
         return $this->recipes;
     }

     public function addRecipe(Recipes $recipe): self
     {
         if (!$this->recipes->contains($recipe)) {
             $this->recipes[] = $recipe;
             $recipe->addIngredient($this);
         }

         return $this;
     }

     public function removeRecipe(Recipes $recipe): self
     {
         if ($this->recipes->contains($recipe)) {
             $this->recipes->removeElement($recipe);
             $recipe->removeIngredient($this);
         }

         return $this;
     } 
     public function __toString(){
        return $this->name;
    }
}
