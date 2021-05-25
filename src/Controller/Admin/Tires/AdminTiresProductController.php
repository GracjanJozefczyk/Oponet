<?php


namespace App\Controller\Admin\Tires;


use App\Entity\Tire\TireProduct;
use App\Form\Tires\TireProductFormType;
use App\Repository\Tire\TireBrandRepository;
use App\Repository\Tire\TireProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminTiresProductController extends AbstractController
{
    /**
     * @var TireProductRepository
     */
    private $tireProductRepository;

    public function __construct(TireProductRepository $tireProductRepository)
    {
        $this->tireProductRepository = $tireProductRepository;
    }

    /**
     * @Route("/admin/tires/products", name="admin_tires_products")
     */
    public function list(TireProductRepository $tireProductRepository, Request $request, PaginatorInterface $paginator)
    {
        $queryBuilder = $tireProductRepository->paginatorQuery($request->query->getAlnum('orderBy'));
        $paginator = $paginator->paginate(
            $queryBuilder,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('admin/tires/products/list.html.twig', [
            'pagination' => $paginator
        ]);

    }

    /**
     * @Route("/admin/tires/products/new", name="admin_tires_products_new")
     */
    public function new(Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(TireProductFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $product = $form->getData();
                $em->persist($product);
                $em->persist($product->setSlug($this->slugger($form)));
            // If identical product exists - add quantity
            } elseif ($entity = $this->checkIfSameExists($form)) {
                $entity->setQuantity($entity->getQuantity() + $form['quantity']->getData());
            }
            $em->flush();
            return $this->redirectToRoute('admin_tires_products');
        }
        return $this->render('admin/tires/products/new.html.twig', [
            'productForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/tires/products/{id}/edit", name="admin_tires_products_edit")
     */
    public function edit(TireProduct $product, EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(TireProductFormType::class, $product);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($product);
            $em->persist($product->setSlug($this->slugger($form)));
            $em->flush();

            return $this->redirectToRoute('admin_tires_products');
        }
        return $this->render('admin/tires/products/edit.html.twig', [
            'productForm' => $form->createView()
        ]);

    }

    /**
     * @Route("/admin/tires/products/{id}/delete", name="admin_tires_products_delete")
     */
    public function delete(int $id, TireProductRepository $tireProductRepository): Response
    {
        $tire = $tireProductRepository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($tire);
        $em->flush();

        return $this->redirectToRoute('admin_tires_products');
    }

    private function checkIfSameExists($form): TireProduct
    {
        return $this->tireProductRepository->findOneBy(
            [
                'model' => $form['model']->getData(),
                'price' => $form['price']->getData(),
                'year' => $form['year']->getData(),
                'width' => $form['width']->getData(),
                'height' => $form['height']->getData(),
                'rimSize' => $form['rimSize']->getData(),
                'loadIndex' => $form['loadIndex']->getData(),
                'speedRating' => $form['speedRating']->getData(),
                'noiseLevel' => $form['noiseLevel']->getData(),
                'fuelEfficiency' => $form['fuelEfficiency']->getData(),
                'wetGrip' => $form['wetGrip']->getData(),
            ]
        );
    }

    private function slugger($form): string
    {
        $data = $form->getViewData();
        $model = $data->getModel()->getName();
        $width = $data->getWidth();
        $rimSize = $data->getRimSize();
        $height = $data->getHeight();
        $model = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $model);

        return "$model-$width-$height-R$rimSize-".uniqid();
    }
}
