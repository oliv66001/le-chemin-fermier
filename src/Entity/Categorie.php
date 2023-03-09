<?php

namespace App\Entity;

use App\Entity\MyTrait\SlugTrait;
use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    use SlugTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageUrl = null;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Entree::class)]
    private Collection $entree;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Plat::class)]
    private Collection $plat;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Dessert::class)]
    private Collection $dessert;


    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Drink::class)]
    private Collection $drink;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Wine::class)]
    private Collection $wine;

    public function __construct()
    {
        $this->entree = new ArrayCollection();
        $this->plat = new ArrayCollection();
        $this->dessert = new ArrayCollection();
        $this->drink = new ArrayCollection();
        $this->wine = new ArrayCollection();
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

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(?string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * @return Collection<int, Entree>
     */
    public function getEntree(): Collection
    {
        return $this->entree;
    }

    public function addEntree(Entree $entree): self
    {
        if (!$this->entree->contains($entree)) {
            $this->entree->add($entree);
            $entree->setCategorie($this);
        }

        return $this;
    }

    public function removeEntree(Entree $entree): self
    {
        if ($this->entree->removeElement($entree)) {
            // set the owning side to null (unless already changed)
            if ($entree->getCategorie() === $this) {
                $entree->setCategorie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Plat>
     */
    public function getPlat(): Collection
    {
        return $this->plat;
    }

    public function addPlat(Plat $plat): self
    {
        if (!$this->plat->contains($plat)) {
            $this->plat->add($plat);
            $plat->setCategorie($this);
        }

        return $this;
    }

    public function removePlat(Plat $plat): self
    {
        if ($this->plat->removeElement($plat)) {
            // set the owning side to null (unless already changed)
            if ($plat->getCategorie() === $this) {
                $plat->setCategorie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Dessert>
     */
    public function getDessert(): Collection
    {
        return $this->dessert;
    }

    public function addDessert(Dessert $dessert): self
    {
        if (!$this->dessert->contains($dessert)) {
            $this->dessert->add($dessert);
            $dessert->setCategorie($this);
        }

        return $this;
    }

    public function removeDessert(Dessert $dessert): self
    {
        if ($this->dessert->removeElement($dessert)) {
            // set the owning side to null (unless already changed)
            if ($dessert->getCategorie() === $this) {
                $dessert->setCategorie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Drink>
     */
    public function getDrink(): Collection
    {
        return $this->drink;
    }

    public function addDrink(Drink $drink): self
    {
        if (!$this->drink->contains($drink)) {
            $this->drink->add($drink);
            $drink->setCategorie($this);
        }

        return $this;
    }

    public function removeDrink(Drink $drink): self
    {
        if ($this->drink->removeElement($drink)) {
            // set the owning side to null (unless already changed)
            if ($drink->getCategorie() === $this) {
                $drink->setCategorie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Wine>
     */
    public function getWine(): Collection
    {
        return $this->wine;
    }

    public function addWine(Wine $wine): self
    {
        if (!$this->wine->contains($wine)) {
            $this->wine->add($wine);
            $wine->setCategorie($this);
        }

        return $this;
    }

    public function removeWine(Wine $wine): self
    {
        if ($this->wine->removeElement($wine)) {
            // set the owning side to null (unless already changed)
            if ($wine->getCategorie() === $this) {
                $wine->setCategorie(null);
            }
        }

        return $this;
    }
}
