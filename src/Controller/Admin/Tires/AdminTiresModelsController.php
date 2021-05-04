<?php


namespace App\Controller\Admin\Tires;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminTiresModelsController extends AbstractController
{
    /**
     * @Route("/admin/tires/models", name="admin_tires_models")
     */
    public function list()
    {
        return $this->render('admin/tires/models/list.html.twig');
    }

}