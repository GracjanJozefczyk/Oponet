<?php

namespace App\Entity\Tire;

use App\Repository\Tire\TireBrandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=TireBrandRepository::class)
 * @UniqueEntity("name")
 */
class TireBrand
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
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageUrl;

    /**
     * @ORM\OneToMany(targetEntity=TireModel::class, mappedBy="brand", orphanRemoval=true)
     */
    private $tireModels;

    public function __construct()
    {
        $this->tireModels = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return 'uploads/tires_brands/'.$this->imageUrl;
    }

    public function setImageUrl(?string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * @return Collection|TireModel[]
     */
    public function getTireModels(): Collection
    {
        return $this->tireModels;
    }

    public function addTireModel(TireModel $tireModel): self
    {
        if (!$this->tireModels->contains($tireModel)) {
            $this->tireModels[] = $tireModel;
            $tireModel->setBrand($this);
        }

        return $this;
    }

    public function removeTireModel(TireModel $tireModel): self
    {
        if ($this->tireModels->removeElement($tireModel)) {
            // set the owning side to null (unless already changed)
            if ($tireModel->getBrand() === $this) {
                $tireModel->setBrand(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
