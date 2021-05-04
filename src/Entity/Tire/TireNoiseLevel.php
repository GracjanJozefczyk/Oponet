<?php

namespace App\Entity\Tire;

use App\Repository\Tire\TireNoiseLevelRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TireNoiseLevelRepository::class)
 */
class TireNoiseLevel
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
    private $noiseLevel;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNoiseLevel(): ?string
    {
        return $this->noiseLevel;
    }

    public function setNoiseLevel(string $noiseLevel): self
    {
        $this->noiseLevel = $noiseLevel;

        return $this;
    }
}
