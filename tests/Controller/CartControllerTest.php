<?php

namespace App\Tests\Controller;

use App\Tests\CartAssertionsTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\AbstractBrowser;

class CartControllerTest extends WebTestCase
{
    use CartAssertionsTrait;

    public function testCartIsEmpty()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/cart');

        $this->assertResponseIsSuccessful();
        $this->assertCartIsEmpty($crawler);
    }

    public function testAddProductToCart()
    {
        $client = static::createClient();
        $product = $this->addRandomProductToCart($client);
        $crawler = $client->request('GET', '/cart');

        $this->assertResponseIsSuccessful();
        $this->assertCartItemsCountEquals($crawler, 1);
        $this->assertCartContainsProductWithQuantity($crawler, $product['name'], 1);
        $this->assertCartTotalEquals($crawler, $product['price']);
    }

    public function testAddProductTwiceToCart()
    {
        $client = static::createClient();

        $product = $this->getRandomProduct($client);

        for ($i=0; $i<2; $i++) {
            $crawler = $client->request('GET', $product['url']);
            $form = $crawler->filter('form')->form();
            $client->submit($form);
            $crawler = $client->followRedirect();
        }

        $crawler = $client->request('GET', '/cart');

        $this->assertResponseIsSuccessful();
        $this->assertCartItemsCountEquals($crawler, 1);
        $this->assertCartContainsProductWithQuantity($crawler, $product['name'], 2);
        $this->assertCartTotalEquals($crawler, $product['price'] * 2);
    }

    public function testRemoveProductFromCart()
    {
        $client = static::createClient();
        $product = $this->addRandomProductToCart($client);

        $crawler = $client->request('GET', '/cart');
        $this->assertCartItemsCountEquals($crawler, 1);

        $client->submitForm('Remove');
        $crawler = $client->followRedirect();

        $this->assertCartNotContainsProduct($crawler, $product['name']);
    }

    public function testClearCart()
    {
        $client = static::createClient();
        $this->addRandomProductToCart($client);

        $client->request('GET', '/cart');

        $client->submitForm('Clear');
        $crawler = $client->followRedirect();

        $this->assertCartIsEmpty($crawler);
    }

    public function testUpdateQuantity()
    {
        $client = static::createClient();
        $product = $this->addRandomProductToCart($client);

        $crawler = $client->request('GET', '/cart');

        $cartForm = $crawler->filter('.col-md-8 form')->form([
            'cart[items][0][quantity]' => 4
        ]);
        $client->submit($cartForm);
        $crawler = $client->followRedirect();

        $this->assertCartTotalEquals($crawler, $product['price'] * 4);
        $this->assertCartContainsProductWithQuantity($crawler, $product['name'], 4);
    }

    private function getRandomProduct(AbstractBrowser $client): array
    {
        $crawler = $client->request('GET', '/search');
        $productNode = $crawler->filter('.product-card')->eq(rand(0, 8));
        $productName = $productNode->filter('.card-header')->getNode(0)->textContent;
        $productPrice = (float) $productNode->filter('.product-price')->getNode(0)->textContent;
        $productLink = $productNode->filter('a')->link();

        return [
            'name' => $productName,
            'price' => $productPrice,
            'url' => $productLink->getUri()
        ];
    }

    private function addRandomProductToCart(AbstractBrowser $client, int $quantity = 1): array
    {
        $product = $this->getRandomProduct($client);

        $crawler = $client->request('GET', $product['url']);
        $form = $crawler->filter('form')->form();
        $form->setValues(['add_to_cart[quantity]' => $quantity]);

        $client->submit($form);

        return $product;
    }
}
