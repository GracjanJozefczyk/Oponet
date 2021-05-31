<?php

namespace App\Controller;

use App\Manager\CartManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class TestController extends AbstractController
{
    private $parameterBagInterface;

    public function __construct(ParameterBagInterface $parameterBagInterface)
    {
        $this->parameterBagInterface = $parameterBagInterface;
    }
    /**
     * @Route("/test", name="test")
     */
    public function index(ParameterBagInterface $params): Response
    {
        //$roles = $this->getParameter('security.role_hierarchy.roles');
        $params = $this->parameterBagInterface->get('security.role_hierarchy.roles');
        dd(array_keys($params));

    }
}
