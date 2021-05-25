<?php


namespace App\Controller\Admin\Tires;

use App\Entity\Tire\TireBrand;
use App\Form\Tires\TireBrandFormType;
use App\Repository\Tire\TireBrandRepository;
use App\Service\UploaderHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminTiresBrandsController extends AbstractController
{
    /**
     * @Route("/admin/tires/brands", name="admin_tires_brands")
     */
    public function list(TireBrandRepository $tireBrandRepository): Response
    {
        $brands = $tireBrandRepository->findAll();

        return $this->render('admin/tires/brands/list.html.twig', [
            'brands' => $brands
        ]);
    }

    /**
     * @Route("/admin/tires/brands/new", name="admin_tires_brands_new")
     */
    public function new(EntityManagerInterface $em, Request $request): Response
    {
        $form = $this->createForm(TireBrandFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var TireBrand $brand */
            $brand = $form->getData();

            $em->persist($brand);
            $em->flush();

            return $this->redirectToRoute('admin_tires_brands');
        }
        return $this->render('admin/tires/brands/new.html.twig', [
            'brandForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/tires/brands/{id}/edit", name="admin_tires_brands_edit")
     */
    public function edit(TireBrand $brand, EntityManagerInterface $em, Request $request): Response
    {
        $form = $this->createForm(TireBrandFormType::class, $brand);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($brand);
            $em->flush();

            return $this->redirectToRoute('admin_tires_brands');
        }

        return $this->render('admin/tires/brands/edit.html.twig', [
            'brandForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/tires/brands/{id}/delete", name="admin_tires_brands_delete")
     */
    public function delete(int $id, TireBrandRepository $tireBrandRepository): Response
    {
        $brand = $tireBrandRepository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($brand);
        $em->flush();

        return $this->redirectToRoute('admin_tires_brands');
    }

    /**
     * @Route("/admin/tires/brands/uploadImage", name="admin_tires_brands_uploadImage")
     */
    public function uploadImage(Request $request, UploaderHelper $uploaderHelper): Response
    {
        /** @var UploadedFile $uploadedFile */
        $uploadedFile = $request->files->get('file');

        if ($uploadedFile) {
            $filename = $uploaderHelper->uploadBrandImage($uploadedFile);
        }
        return $this->json(['filename' => $filename], 200);
    }

}
