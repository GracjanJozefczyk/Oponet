<?php

namespace App\Entity\Order;

use App\Entity\Tire\TireProduct;
use App\Repository\Order\OrderItemRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=OrderItemRepository::class)
 */
class OrderItem
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=TireProduct::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $tireProduct;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\GreaterThanOrEqual(1)
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="items")
     * @ORM\JoinColumn(nullable=false)
     */
    private $orderRef;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTireProduct(): ?TireProduct
    {
        return $this->tireProduct;
    }

    public function setTireProduct(?TireProduct $tireProduct): self
    {
        $this->tireProduct = $tireProduct;

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

    public function getOrderRef(): ?Order
    {
        return $this->orderRef;
    }

    public function setOrderRef(?Order $orderRef): self
    {
        $this->orderRef = $orderRef;

        return $this;
    }

    public function equals(OrderItem $item): bool
    {
        return $this->getTireProduct()->getId() === $item->getTireProduct()->getId();
    }

    public function getTotal(): int
    {
        return $this->getTireProduct()->getPrice() * $this->getQuantity();
    }
}
