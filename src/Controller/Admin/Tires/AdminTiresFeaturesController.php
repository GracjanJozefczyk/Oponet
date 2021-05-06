<?php


namespace App\Controller\Admin\Tires;


use App\Form\Tires\TireHeightFormType;
use App\Form\Tires\TireWidthFormType;
use App\Repository\Tire\TireHeightRepository;
use App\Repository\Tire\TireWidthRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminTiresFeaturesController extends AbstractController
{
    private $tireWidthRepository;
    private $tireHeightRepository;

    public function __construct(
        TireWidthRepository $tireWidthRepository,
        TireHeightRepository $tireHeightRepository
    )
    {
        $this->tireWidthRepository = $tireWidthRepository;
        $this->tireHeightRepository = $tireHeightRepository;
    }

    /**
     * @Route("/admin/tires/features", name="admin_tires_features")
     */
    public function list(Request $request)
    {
        $tireWidthForm = $this->createForm(TireWidthFormType::class);
        $tireHeightForm = $this->createForm(TireHeightFormType::class);

        $tireWidthForm->handleRequest($request);
        $this->formHandler($tireWidthForm);

        $tireHeightForm->handleRequest($request);
        $this->formHandler($tireHeightForm);

        return $this->render('admin/tires/features/list.html.twig', [
            'widthForm' => $tireWidthForm->createView(),
            'heightForm' => $tireHeightForm->createView(),
            'tiresWidth' => $this->tireWidthRepository->findAllAndSort(),
            'tiresHeight' => $this->tireHeightRepository->findAllAndSort(),
        ]);
    }

    /**
     * @Route("/admin/tires/features/{feature}/{id}/delete", name="admin_tires_features_delete")
     */
    public function featureDeleter(string $feature, int $id): Response
    {
        if ($feature === 'height') {
            $feature = $this->tireHeightRepository->find($id);
        } elseif ($feature === 'width') {
            $feature = $this->tireWidthRepository->find($id);
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($feature);
        $em->flush();

        return $this->redirectToRoute('admin_tires_features');
    }

    protected function formHandler($form)
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();
        }
    }
}