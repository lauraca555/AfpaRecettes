<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 * @UniqueEntity("nom", message="Cette categorie existe déjà.")
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
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Recipy::class, mappedBy="categorie")
     */
    private $recipies;

    public function __construct()
    {
        $this->recipies = new ArrayCollection();
        
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

    /**
     * @return Collection|Recipy[]
     */
    public function getRecipies(): Collection
    {
        return $this->recipies;
    }

    public function addRecipy(Recipy $recipy): self
    {
        if (!$this->recipies->contains($recipy)) {
            $this->recipies[] = $recipy;
            $recipy->setCategorie($this);
        }

        return $this;
    }

    public function removeRecipy(Recipy $recipy): self
    {
        if ($this->recipies->removeElement($recipy)) {
            // set the owning side to null (unless already changed)
            if ($recipy->getCategorie() === $this) {
                $recipy->setCategorie(null);
            }
        }

        return $this;
    }
}
