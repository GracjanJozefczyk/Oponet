<?php


namespace App\Storage;


use App\Entity\Order\Order;
use App\Repository\Order\OrderRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Security;

/**
 * Class CartSessionStorage
 * @package App\Storage
 */
class CartSessionStorage
{
    /**
     * The session storage
     *
     * @var SessionInterface
     */
    private $session;

    /**
     * The cart repository
     *
     * @var OrderRepository
     */
    private $cartRepository;

    /**
     * @var string
     */
    const CART_KEY_NAME = 'cart_id';
    /**
     * @var Security
     */
    private $security;

    /**
     * CartSessionStorage constructor
     *
     * @param SessionInterface $session
     * @param OrderRepository $cartRepository
     */
    public function __construct(SessionInterface $session, OrderRepository $cartRepository, Security $security)
    {
        $this->session = $session;
        $this->cartRepository = $cartRepository;
        $this->security = $security;
    }

    /**
     * Gets the cart in session
     *
     * @return Order|null
     */
    public function getCart(): ?Order
    {
        if ($user = $this->security->getUser()) {
            return $this->cartRepository->findOneBy([
                'user' => $user->getId(),
                'status' => Order::STATUS_CART
            ]);
        } else {
            return $this->cartRepository->findOneBy([
                'id' => $this->getCartId(),
                'status' => Order::STATUS_CART
            ]);
        }
    }

    /**
     * Sets the cart in session
     *
     * @param Order $cart
     */
    public function setCart(Order $cart): void
    {
        $this->session->set(self::CART_KEY_NAME, $cart->getId());
    }

    /**
     * Returns the card id
     *
     * @return int|null
     */
    private function getCartId(): ?int
    {
        return $this->session->get(self::CART_KEY_NAME);
    }

}