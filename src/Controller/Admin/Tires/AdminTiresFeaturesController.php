<?php


namespace App\Controller\Admin\Tires;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminTiresFeaturesController extends AbstractController
{
    /**
     * @Route("/admin/tires/features", name="admin_tires_features")
     */
    public function list()
    {
        return $this->render('admin/tires/features/list.html.twig');
    }

}