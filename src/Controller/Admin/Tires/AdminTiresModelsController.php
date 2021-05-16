<?php


namespace App\Controller\Admin\Tires;


use App\Entity\Tire\TireModel;
use App\Form\Tires\TireModelFormType;
use App\Repository\Tire\TireModelRepository;
use App\Service\UploaderHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminTiresModelsController extends AbstractController
{
    /**
     * @Route("/admin/tires/models", name="admin_tires_models")
     */
    public function list(TireModelRepository $tireModelRepository)
    {
        $models = $tireModelRepository->findAll();

        return $this->render('admin/tires/models/list.html.twig', [
            'models' => $models
        ]);
    }

    /**
     * @Route("/admin/tires/models/new", name="admin_tires_models_new")
     */
    public function new(EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(TireModelFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            /** @var TireModel $model */
            $model = $form->getData();

            $em->persist($model);
            $em->flush();

            return $this->redirectToRoute('admin_tires_models');
        }
        return $this->render('admin/tires/models/new.html.twig', [
            'modelForm' => $form->createView()
        ]);

    }

    /**
     * @Route("/admin/tires/models/{id}/edit", name="admin_tires_models_edit")
     */
    public function edit(TireModel $model, EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(TireModelFormType::class, $model);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($model);
            $em->flush();

            return $this->redirectToRoute('admin_tires_models');
        }

        return $this->render('admin/tires/models/edit.html.twig', [
            'modelForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/tires/models/{id}/delete", name="admin_tires_models_delete")
     */
    public function delete(TireModel $model)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($model);
        $em->flush();

        return $this->redirectToRoute('admin_tires_models');
    }

    /**
     * @Route("/admin/tires/models/deleteImage/{img}", name="admin_tires_models_deleteImage")
     */
    public function deleteImage(string $img, UploaderHelper $uploaderHelper)
    {
        $uploaderHelper->deleteModelImage($img);

        return $this->json(null, 200);
    }

    /**
     * @Route("/admin/tires/models/uploadImage", name="admin_tires_models_uploadImage")
     */
    public function uploadImage(Request $request, UploaderHelper $uploaderHelper): Response
    {
        /** @var UploadedFile $uploadedFile */
        $uploadedFile = $request->files->get('file');

        if ($uploadedFile) {
            $filename = $uploaderHelper->uploadModelImage($uploadedFile);
        }
        return $this->json(['filename' => $filename], 200);
    }

}