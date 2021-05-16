<?php

namespace App\Entity\Tire;

use App\Repository\Tire\TireWetGripRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=TireWetGripRepository::class)
 * @UniqueEntity("wetGrip")
 */
class TireWetGrip
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
    private $wetGrip;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWetGrip(): ?string
    {
        return $this->wetGrip;
    }

    public function setWetGrip(string $wetGrip): self
    {
        $this->wetGrip = $wetGrip;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getWetGrip();
    }
}
