<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Persons::class)]
    private $title;

    public function __construct()
    {
        $this->title = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Persons>
     */
    public function getTitle(): Collection
    {
        return $this->title;
    }

    public function addTitle(Persons $title): self
    {
        if (!$this->title->contains($title)) {
            $this->title[] = $title;
            $title->setCategory($this);
        }

        return $this;
    }

    public function removeTitle(Persons $title): self
    {
        if ($this->title->removeElement($title)) {
            // set the owning side to null (unless already changed)
            if ($title->getCategory() === $this) {
                $title->setCategory(null);
            }
        }

        return $this;
    }
}
