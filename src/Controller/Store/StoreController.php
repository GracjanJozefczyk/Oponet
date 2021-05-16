<?php


namespace App\Controller\Store;


use App\Repository\Tire\TireModelRepository;
use App\Repository\Tire\TireProductRepository;
use App\Repository\Tire\TireRimSizeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StoreController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(TireModelRepository $repository, TireRimSizeRepository $tireRimSizeRepository): Response
    {
        $models = $repository->findAll();
        $rimSizes = $tireRimSizeRepository->findAllAndSort();

        return $this->render('store/index.html.twig', [
            'models' => $models,
            'rimSizes' => $rimSizes
        ]);
    }

    /**
     * @Route("/api/getwidths/{rimSize}", name="api_get_widths")
     */
    public function getWidths(TireProductRepository $tireProductRepository, $rimSize)
    {
        $widths = $tireProductRepository->findWidthsByRimSize($rimSize);
        return $this->json($widths, 200);
    }

    /**
     * @Route("/api/getheights/{width}", name="api_get_heights")
     */
    public function getHeight(TireProductRepository $tireProductRepository, $width)
    {
        $heights = $tireProductRepository->findHeightsByWidth($width);
        return $this->json($heights, 200);
    }

}
