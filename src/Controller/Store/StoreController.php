<?php


namespace App\Controller\Store;


use App\Entity\Tire\TireProduct;
use App\Repository\Tire\TireBrandRepository;
use App\Repository\Tire\TireModelRepository;
use App\Repository\Tire\TireProductRepository;
use App\Repository\Tire\TireWidthRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StoreController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(TireModelRepository $repository, TireWidthRepository $tireWidthRepository, TireBrandRepository $tireBrandRepository): Response
    {
        $models = $repository->findAll();
        $widths = $tireWidthRepository->findAllAndSort();
        $brands = $tireBrandRepository->findAll();

        return $this->render('store/index.html.twig', [
            'models' => $models,
            'widths' => $widths,
            'brands' => $brands
        ]);
    }

    /**
     * @Route("/show-product/{slug}", name="show_product")
     */
    public function showProduct(TireProductRepository $tireProductRepository, $slug)
    {
        $product = $tireProductRepository->findOneBy(['slug' => $slug]);

        return $this->render('store/show.html.twig', [
            'product' => $product
        ]);
    }

    /**
     * @Route("/search", name="search")
     */
    public function search(PaginatorInterface $paginator, TireBrandRepository $tireBrandRepository, TireWidthRepository $tireWidthRepository, TireProductRepository $tireProductRepository, Request $request)
    {
        $products = $tireProductRepository->findByAny(
            $request->query->getInt('width'),
            $request->query->getInt('height'),
            $request->query->getInt('rimSize'),
            $request->query->get('seasons'),
            $request->query->get('brands'),
            $request->query->get('sort')
        );

        $paginator = $paginator->paginate(
            $products,
            $request->query->getInt('page', 1),
           9
        );

        return $this->render('store/search.html.twig', [
            'products' => $paginator,
            'widths' => $tireWidthRepository->findAllAndSort(),
            'brands' => $tireBrandRepository->findAll(),
            'minPrice' => $this->getLowestPrice($paginator->getItems()),
            'maxPrice' => $this->getHighestPrice($paginator->getItems())
        ]);
    }

    private function getHighestPrice($products) {
        $max = $products[0]->getPrice();
        foreach ($products as $product) {
            /* @var $product TireProduct */
            if ($product->getPrice() > $max) {
                $max = $product->getPrice();
            }
        }
        return $max;
    }

    private function getLowestPrice($products) {
        $min = $products[0]->getPrice();
        foreach ($products as $product) {
            /* @var $product TireProduct */
            if ($product->getPrice() < $min) {
                $min = $product->getPrice();
            }
        }
        return $min;
    }

    /**
     * @Route("/api/getheights/{width}", name="api_get_heights")
     */
    public function getHeights(TireProductRepository $tireProductRepository, $width)
    {
        $heights = $tireProductRepository->findHeightsByWidth($width);
        return $this->json($heights, 200);
    }

    /**
     * @Route("/api/getrims/{width}/{height}", name="api_get_rims")
     */
    public function getRims(TireProductRepository $tireProductRepository, $width, $height)
    {
        $widths = $tireProductRepository->findRimByWidthAndHeight($width, $height);
        return $this->json($widths, 200);
    }
}
