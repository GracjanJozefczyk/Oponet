<?php


namespace App\Tests;


use Symfony\Component\BrowserKit\AbstractBrowser;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\DomCrawler\Form;

trait UserAuthenticationTrait
{
    /**
     * @param AbstractBrowser $browser
     * @return Crawler|null
     */
    public static function loginAsAdmin(AbstractBrowser $browser): ?Crawler
    {
        $form = self::loginForm($browser);
        $form['email'] = 'admin@oponet.pl';
        $form['password'] = 'plainPassword';
        return $browser->submit($form);
    }

    /**
     * @param AbstractBrowser $browser
     * @return Crawler|null
     */
    public static function loginAsManager(AbstractBrowser $browser): ?Crawler
    {
        $form = self::loginForm($browser);
        $form['email'] = 'info@oponet.pl';
        $form['password'] = 'plainPassword';
        return $browser->submit($form);
    }

    /**
     * @param AbstractBrowser $browser
     * @return Crawler|null
     */
    public static function loginAsSalesman(AbstractBrowser $browser): ?Crawler
    {
        $form = self::loginForm($browser);
        $form['email'] = 'store@oponet.pl';
        $form['password'] = 'plainPassword';
        return $browser->submit($form);
    }

    /**
     * @param AbstractBrowser $browser
     * @return Crawler|null
     */
    public static function loginAsWarehouseman(AbstractBrowser $browser): ?Crawler
    {
        $form = self::loginForm($browser);
        $form['email'] = 'warehouse@oponet.pl';
        $form['password'] = 'plainPassword';
        return $browser->submit($form);
    }

    /**
     * @param AbstractBrowser $browser
     * @return Crawler|null
     */
    public static function loginAsUser(AbstractBrowser $browser): ?Crawler
    {
        $form = self::loginForm($browser);
        $form['email'] = 'user@oponet.pl';
        $form['password'] = 'plainPassword';
        return $browser->submit($form);
    }

    /**
     * @param AbstractBrowser $browser
     * @return Form
     */
    private static function loginForm(AbstractBrowser $browser): Form
    {
        $crawler = $browser->request('GET', '/login');
        $button = $crawler->selectButton('submit');
        return $button->form();
    }
}