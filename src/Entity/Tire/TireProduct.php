<?php

namespace App\Entity\Tire;

use App\Repository\Tire\TireProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TireProductRepository::class)
 */
class TireProduct
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="integer")
     */
    private $year;

    /**
     * @ORM\Column(type="boolean")
     */
    private $runOnFlat;

    /**
     * @ORM\Column(type="boolean")
     */
    private $reinforced;

    /**
     * @ORM\ManyToOne(targetEntity=TireWidth::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $width;

    /**
     * @ORM\ManyToOne(targetEntity=TireHeight::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $height;

    /**
     * @ORM\ManyToOne(targetEntity=TireRimSize::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $rimSize;

    /**
     * @ORM\ManyToOne(targetEntity=TireLoadIndex::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $loadIndex;

    /**
     * @ORM\ManyToOne(targetEntity=TireSpeedRating::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $speedRating;

    /**
     * @ORM\ManyToOne(targetEntity=TireNoiseLevel::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $noiseLevel;

    /**
     * @ORM\ManyToOne(targetEntity=TireFuelEfficiency::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $fuelEfficiency;

    /**
     * @ORM\ManyToOne(targetEntity=TireWetGrip::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $wetGrip;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

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

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getRunOnFlat(): ?bool
    {
        return $this->runOnFlat;
    }

    public function setRunOnFlat(bool $runOnFlat): self
    {
        $this->runOnFlat = $runOnFlat;

        return $this;
    }

    public function getReinforced(): ?bool
    {
        return $this->reinforced;
    }

    public function setReinforced(bool $reinforced): self
    {
        $this->reinforced = $reinforced;

        return $this;
    }

    public function getWidth(): ?TireWidth
    {
        return $this->width;
    }

    public function setWidth(?TireWidth $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): ?TireHeight
    {
        return $this->height;
    }

    public function setHeight(?TireHeight $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getRimSize(): ?TireRimSize
    {
        return $this->rimSize;
    }

    public function setRimSize(?TireRimSize $rimSize): self
    {
        $this->rimSize = $rimSize;

        return $this;
    }

    public function getLoadIndex(): ?TireLoadIndex
    {
        return $this->loadIndex;
    }

    public function setLoadIndex(?TireLoadIndex $loadIndex): self
    {
        $this->loadIndex = $loadIndex;

        return $this;
    }

    public function getSpeedRating(): ?TireSpeedRating
    {
        return $this->speedRating;
    }

    public function setSpeedRating(?TireSpeedRating $speedRating): self
    {
        $this->speedRating = $speedRating;

        return $this;
    }

    public function getNoiseLevel(): ?TireNoiseLevel
    {
        return $this->noiseLevel;
    }

    public function setNoiseLevel(?TireNoiseLevel $noiseLevel): self
    {
        $this->noiseLevel = $noiseLevel;

        return $this;
    }

    public function getFuelEfficiency(): ?TireFuelEfficiency
    {
        return $this->fuelEfficiency;
    }

    public function setFuelEfficiency(?TireFuelEfficiency $fuelEfficiency): self
    {
        $this->fuelEfficiency = $fuelEfficiency;

        return $this;
    }

    public function getWetGrip(): ?TireWetGrip
    {
        return $this->wetGrip;
    }

    public function setWetGrip(?TireWetGrip $wetGrip): self
    {
        $this->wetGrip = $wetGrip;

        return $this;
    }
}
