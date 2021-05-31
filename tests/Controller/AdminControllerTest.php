<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Tests\UserAuthenticationTrait as Auth;

class AdminControllerTest extends WebTestCase
{
    use Auth;

    public function testOnlyEmployeesCanSeeDashboard(): void
    {
        $client = static::createClient();

        // Try as anonymous user
        $client->request('GET', '/admin');
        $this->assertResponseRedirects('/login', 302);

        // Try as normal user
        Auth::loginAsUser($client);
        $client->request('GET', '/admin');
        $this->assertResponseStatusCodeSame(403, 'Forbidden');

        // Try as warehouseman user
        Auth::loginAsWarehouseman($client);
        $client->request('GET', '/admin');
        $this->assertResponseIsSuccessful();
    }

}