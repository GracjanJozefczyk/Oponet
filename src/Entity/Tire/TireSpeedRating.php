<?php

namespace App\Entity\Tire;

use App\Repository\Tire\TireSpeedRatingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TireSpeedRatingRepository::class)
 */
class TireSpeedRating
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
    private $speedRating;

    /**
     * @ORM\Column(type="integer")
     */
    private $kmh;

    /**
     * @ORM\Column(type="integer")
     */
    private $mph;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpeedRating(): ?string
    {
        return $this->speedRating;
    }

    public function setSpeedRating(string $speedRating): self
    {
        $this->speedRating = $speedRating;

        return $this;
    }

    public function getKmh(): ?int
    {
        return $this->kmh;
    }

    public function setKmh(int $kmh): self
    {
        $this->kmh = $kmh;

        return $this;
    }

    public function getMph(): ?int
    {
        return $this->mph;
    }

    public function setMph(int $mph): self
    {
        $this->mph = $mph;

        return $this;
    }
}
