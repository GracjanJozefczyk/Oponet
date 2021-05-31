<?php


namespace App\Manager;


use App\Entity\Order\Order;
use App\Factory\OrderFactory;
use App\Storage\CartSessionStorage;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class CartManager
 * @package App\Manager
 */
class CartManager
{
    /**
     * @var CartSessionStorage
     */
    private $cartStorage;
    /**
     * @var OrderFactory
     */
    private $orderFactory;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(CartSessionStorage $cartStorage, OrderFactory $orderFactory, EntityManagerInterface $em)
    {
        $this->cartStorage = $cartStorage;
        $this->orderFactory = $orderFactory;
        $this->em = $em;
    }

    /**
     * Gets the current cart
     *
     * @return Order
     */
    public function getCurrentCart(): Order
    {
        $cart = $this->cartStorage->getCart();

        if (!$cart) {
            $cart = $this->orderFactory->create();
        }

        return $cart;
    }

    /**
     * Persists the cart in database and session
     *
     * @param Order $cart
     */
    public function save(Order $cart): void
    {
        // Persist in database
        $this->em->persist($cart);
        $this->em->flush();
        // Persist in session
        $this->cartStorage->setCart($cart);
    }

}