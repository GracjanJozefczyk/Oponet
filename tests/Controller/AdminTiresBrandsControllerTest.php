<?php

namespace App\Tests\Controller;

use App\Repository\Tire\TireBrandRepository;
use App\Tests\UserAuthenticationTrait as Auth;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AdminTiresBrandsControllerTest extends WebTestCase
{
    use Auth;

    public function testOnlyManagerOrHigherCanSeeTiresBrandsDashboard(): void
    {
        $client = static::createClient();

        // Try as anonymous user
        $client->request('GET', '/admin/tires/brands');
        $this->assertResponseRedirects('/login', 302);

        // Try as normal user
        Auth::loginAsUser($client);
        $client->request('GET', '/admin/tires/brands');
        $this->assertResponseStatusCodeSame(403, 'Forbidden');

        // Try as salesman user
        Auth::loginAsSalesman($client);
        $client->request('GET', '/admin/tires/brands');
        $this->assertResponseStatusCodeSame(403, 'Forbidden');

        // Try as manager user
        Auth::loginAsManager($client);
        $client->request('GET', '/admin/tires/brands');
        $this->assertResponseIsSuccessful();
    }

    public function testOnlyManagerOrHigherCanDeleteTireBrand(): void
    {
        $client = static::createClient();
        $tireBrandRepository = static::$container->get(TireBrandRepository::class);
        $id = $tireBrandRepository->getFirst()->getId();

        $client->request('GET', "/admin/tires/brands/$id/delete");
        $this->assertResponseStatusCodeSame(405, 'Method Not Allowed');

        // Try as anonymous user
        $client->request('DELETE', "/admin/tires/brands/$id/delete");
        $this->assertResponseRedirects('/login', 302);

        // Try as salesman user
        Auth::loginAsSalesman($client);
        $client->request('DELETE', "/admin/tires/brands/$id/delete");
        $this->assertResponseStatusCodeSame(403, 'Forbidden');

        // Try as manager user
        Auth::loginAsManager($client);
        $client->request('DELETE', "/admin/tires/brands/$id/delete");
        $client->followRedirect();
        $this->assertResponseIsSuccessful();
        $this->assertNull($tireBrandRepository->find($id));
    }

    public function testOnlyManagerOrHigherCanAddTireBrand(): void
    {
        $client = static::createClient();
        $tireBrandRepository = static::$container->get(TireBrandRepository::class);

        // Try as anonymous user
        $client->request('GET', "/admin/tires/brands/new");
        $this->assertResponseRedirects('/login', 302);

        // Try as salesman user
        Auth::loginAsSalesman($client);
        $client->request('GET', "/admin/tires/brands/new");
        $this->assertResponseStatusCodeSame(403, 'Forbidden');

        // Try as manager user
        Auth::loginAsManager($client);
        $crawler = $client->request('GET', "/admin/tires/brands/new");
        $this->assertResponseIsSuccessful();
        $button = $crawler->selectButton('submit');
        $form = $button->form();
        $form['tire_brand_form[name]'] = 'Test brand';
        $client->submit($form);
        $newBrand = $tireBrandRepository->findOneBy(['name' => 'Test brand']);
        $this->assertNotNull($newBrand);
    }

    public function testOnlyManagerOrHigherCanEditTireBrand(): void
    {
        $client = static::createClient();
        $tireBrandRepository = static::$container->get(TireBrandRepository::class);
        $id = $tireBrandRepository->getFirst()->getId();

        // Try as anonymous user
        $client->request('GET', "/admin/tires/brands/$id/edit");
        $this->assertResponseRedirects('/login', 302);

        // Try as salesman user
        Auth::loginAsSalesman($client);
        $client->request('GET', "/admin/tires/brands/$id/edit");
        $this->assertResponseStatusCodeSame(403, 'Forbidden');

        // Try as manager user
        Auth::loginAsManager($client);
        $crawler = $client->request('GET', "/admin/tires/brands/$id/edit");
        $this->assertResponseIsSuccessful();
        $button = $crawler->selectButton('submit');
        $form = $button->form();
        $form['tire_brand_form[name]'] = 'Test brand';
        $client->submit($form);
        $updatedBrand = $tireBrandRepository->find($id);
        $this->assertEquals('Test brand', $updatedBrand->getName());
    }

    public function testOnlyManagerOrHigherCanUploadTireBrandImage(): void
    {
        $client = static::createClient();
        $uploadPath = self::$container->getParameter('kernel.root_dir').'/DataFixtures/';
        $uploadedFile = new UploadedFile(
            $uploadPath.'tire_brand_example.jpeg',
            'tire_brand_example.jpg'
        );

        // Try as anonymous user
        $client->request('POST', '/admin/tires/brands/uploadImage');
        $this->assertResponseRedirects('/login', 302);

        // Try as salesman user
        Auth::loginAsSalesman($client);
        $client->request('POST', '/admin/tires/brands/uploadImage', [], [
            'file' => $uploadedFile
        ]);
        $this->assertResponseStatusCodeSame(403, 'Forbidden');

        // Try as manager user
        Auth::loginAsManager($client);
        $client->request('POST', '/admin/tires/brands/uploadImage', [], [
            'file' => $uploadedFile
        ]);
        $this->assertResponseIsSuccessful();





    }
}