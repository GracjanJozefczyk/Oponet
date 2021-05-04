<?php

namespace App\Entity\Tire;

use App\Repository\Tire\TireLoadIndexRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TireLoadIndexRepository::class)
 */
class TireLoadIndex
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
    private $loadIndex;

    /**
     * @ORM\Column(type="integer")
     */
    private $kg;

    /**
     * @ORM\Column(type="integer")
     */
    private $mph;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLoadIndex(): ?string
    {
        return $this->loadIndex;
    }

    public function setLoadIndex(string $loadIndex): self
    {
        $this->loadIndex = $loadIndex;

        return $this;
    }

    public function getKg(): ?int
    {
        return $this->kg;
    }

    public function setKg(int $kg): self
    {
        $this->kg = $kg;

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
