<?php


namespace App\Controller\Api;


use App\Repository\Tire\TireBrandRepository;
use App\Repository\Tire\TireModelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api/getbrands", name="api_get_brands")
     */
    public function getBrands(TireBrandRepository $repository, Request $request): Response
    {
        $term = $request->query->get('term');
        $brands = $repository->autocomplete($term);

        if ($brands) {
            foreach ($brands as $brand) {
                $result[] = $brand['name'];
            }
            return $this->json($result, 201);
        } else {
            return $this->json(null, 204);
        }

    }

    /**
     * @Route("/api/getmodelsbybrand", name="api_get_models_by_brands")
     */
    public function getModelsByBrand(TireModelRepository $repository, Request $request): Response
    {
        $term = $request->query->get('term');
        $models = $repository->getModelsByBrand($term);

        if ($models) {
            foreach ($models as $model) {
                $result[] = $model['name'];
            }
            return $this->json($result, 201);
        } else {
            return $this->json(null, 204);
        }

    }
}