<?php


namespace App\Controller\Store;


use App\Entity\Order\OrderItem;
use App\Entity\Tire\TireBrand;
use App\Entity\Tire\TireModel;
use App\Entity\Tire\TireProduct;
use App\Form\Order\AddToCartType;
use App\Manager\CartManager;
use App\Repository\Tire\TireProductRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class TiresController extends AbstractController
{
    /**
     * @Route("/show-brand/{slug}", name="show_brand")
     */
    public function showBrand(TireBrand $tireBrand): Response
    {
        return $this->render('store/brand.html.twig', [
            'brand' => $tireBrand
        ]);
    }

    /**
     * @Route("/show-model/{slug}", name="show_model")
     */
    public function showModel(TireModel $model, TireProductRepository $tireProductRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $queryBuilder = $tireProductRepository->paginatorQuery($request->query->getAlnum('orderBy'), $model->getId());
        $products = $paginator->paginate(
            $queryBuilder,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('store/model.html.twig', [
            'model' => $model,
            'products' => $products
        ]);
    }

    /**
     * @Route("/show-product/{slug}", name="show_product")
     */
    public function showProduct(TireProduct $product, Request $request, CartManager $cartManager): Response
    {
        $form = $this->createForm(AddToCartType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var OrderItem $item */
            $item = $form->getData();
            $item->setTireProduct($product);

            $cart = $cartManager->getCurrentCart();
            $cart->addItem($item);

            $cartManager->save($cart);

            return $this->redirectToRoute('cart');
        }

        return $this->render('store/product.html.twig', [
            'product' => $product,
            'form' => $form->createView()
        ]);
    }
}