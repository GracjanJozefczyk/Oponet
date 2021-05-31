<?php


namespace App\Factory;


use App\Entity\Order\Order;
use App\Entity\Order\OrderItem;
use App\Entity\Tire\TireProduct;
use Symfony\Component\Security\Core\Security;

/**
 * Class OrderFactory
 * @package App\Factory
 */
class OrderFactory
{
    /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * Creates an order.
     *
     * @return Order
     */
    public function create(): Order
    {
        $order = new Order();
        $order
            ->setStatus(Order::STATUS_CART);

        if ($user = $this->security->getUser()) {
            $order->setUser($user);
        }

        return $order;
    }

    /**
     * Creates an item for a product
     *
     * @param TireProduct $product
     *
     * @return OrderItem
     */
    public function createItem(TireProduct $product): OrderItem
    {
        $item = new OrderItem();
        $item->setTireProduct($product);
        $item->setQuantity(1);

        return $item;
    }
}