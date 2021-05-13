<?php

namespace App\Entity\Vehicle;

use App\Entity\Tire\TireModel;
use App\Repository\Vehicle\VehicleTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VehicleTypeRepository::class)
 */
class VehicleType
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
    private $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageUrl;

    /**
     * @ORM\OneToMany(targetEntity=TireModel::class, mappedBy="vehicleType")
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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
            $tireModel->setVehicleType($this);
        }

        return $this;
    }

    public function removeTireModel(TireModel $tireModel): self
    {
        if ($this->tireModels->removeElement($tireModel)) {
            // set the owning side to null (unless already changed)
            if ($tireModel->getVehicleType() === $this) {
                $tireModel->setVehicleType(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getType();
    }
}
