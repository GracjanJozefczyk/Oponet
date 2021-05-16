<?php


namespace App\Controller\Admin\Tires;


use App\Entity\Tire\TireProduct;
use App\Form\Tires\TireProductFormType;
use App\Repository\Tire\TireProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminTiresProductController extends AbstractController
{
    /**
     * @Route("/admin/tires/products", name="admin_tires_products")
     */
    public function list(TireProductRepository $tireProductRepository)
    {
        $products = $tireProductRepository->findAll();

        return $this->render('admin/tires/products/list.html.twig', [
            'products' => $products
        ]);

    }

    /**
     * @Route("/admin/tires/products/new", name="admin_tires_products_new")
     */
    public function new(Request $request, EntityManagerInterface $em, TireProductRepository $tireProductRepository)
    {
        $form = $this->createForm(TireProductFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $load = $form->getData();
                $em->persist($load);
            } elseif ($entity = $this->checkIfSameExists($tireProductRepository, $form)) {
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

    private function checkIfSameExists(TireProductRepository $tireProductRepository, $form)
    {
        return $tireProductRepository->findOneBy(
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
   
}
