<?php

namespace App\Entity\Tire;

use App\Entity\Vehicle\VehicleType;
use App\Repository\Tire\TireModelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=TireModelRepository::class)
 */
class TireModel
{
    const SEASONS = [
        'Winter' => 'winter',
        'Summer' => 'summer',
        'All seasons' => 'all'
    ];

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
     * @ORM\Column(type="string", length=255)
     */
    private $season;

    /**
     * @ORM\ManyToOne(targetEntity=TireBrand::class, inversedBy="tireModels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $brand;

    /**
     * @ORM\ManyToOne(targetEntity=VehicleType::class, inversedBy="tireModels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vehicleType;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $imagesUrls = [];

    /**
     * @ORM\OneToMany(targetEntity=TireProduct::class, mappedBy="model", orphanRemoval=true)
     */
    private $tireProducts;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $slug;

    public function __construct()
    {
        $this->tireProducts = new ArrayCollection();
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

    public function getSeason(): ?string
    {
        return $this->season;
    }

    public function setSeason(string $season): self
    {
        $this->season = $season;

        return $this;
    }

    public function getBrand(): ?TireBrand
    {
        return $this->brand;
    }

    public function setBrand(?TireBrand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getVehicleType(): ?VehicleType
    {
        return $this->vehicleType;
    }

    public function setVehicleType(?VehicleType $vehicleType): self
    {
        $this->vehicleType = $vehicleType;

        return $this;
    }

    public function getImagesUrls(): ?array
    {
        return $this->imagesUrls;
    }

    public function setImagesUrls(?array $imagesUrls): self
    {
        $this->imagesUrls = $imagesUrls;

        return $this;
    }

    public function getImagesPaths(): ?array
    {
        return preg_filter('/^/', 'uploads/tires_models/', $this->imagesUrls);
    }

    /**
     * @return Collection|TireProduct[]
     */
    public function getTireProducts(): Collection
    {
        return $this->tireProducts;
    }

    public function addTireProduct(TireProduct $tireProduct): self
    {
        if (!$this->tireProducts->contains($tireProduct)) {
            $this->tireProducts[] = $tireProduct;
            $tireProduct->setModel($this);
        }

        return $this;
    }

    public function removeTireProduct(TireProduct $tireProduct): self
    {
        if ($this->tireProducts->removeElement($tireProduct)) {
            // set the owning side to null (unless already changed)
            if ($tireProduct->getModel() === $this) {
                $tireProduct->setModel(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getName();
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
