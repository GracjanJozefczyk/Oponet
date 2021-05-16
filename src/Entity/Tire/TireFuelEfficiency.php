<?php

namespace App\Entity\Tire;

use App\Repository\Tire\TireFuelEfficiencyRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=TireFuelEfficiencyRepository::class)
 * @UniqueEntity("fuelEfficiency")
 */
class TireFuelEfficiency
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $fuelEfficiency;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFuelEfficiency(): ?string
    {
        return $this->fuelEfficiency;
    }

    public function setFuelEfficiency(string $fuelEfficiency): self
    {
        $this->fuelEfficiency = $fuelEfficiency;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getFuelEfficiency();
    }
}
