<?php


namespace App\Controller\Admin\Tires;

use App\Form\Tires\TireFuelEfficiencyFormType;
use App\Form\Tires\TireHeightFormType;
use App\Form\Tires\TireLoadIndexFormType;
use App\Form\Tires\TireNoiseLevelFormType;
use App\Form\Tires\TireSpeedRatingFormType;
use App\Form\Tires\TireWetGripFormType;
use App\Form\Tires\TireWidthFormType;
use App\Form\Tires\TireRimSizeFormType;
use App\Repository\Tire\TireFuelEfficiencyRepository;
use App\Repository\Tire\TireHeightRepository;
use App\Repository\Tire\TireLoadIndexRepository;
use App\Repository\Tire\TireNoiseLevelRepository;
use App\Repository\Tire\TireSpeedRatingRepository;
use App\Repository\Tire\TireWetGripRepository;
use App\Repository\Tire\TireWidthRepository;
use App\Repository\Tire\TireRimSizeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminTiresFeaturesController extends AbstractController
{
    private $tireWidthRepository;
    private $tireHeightRepository;
    private $tireRimSizeRepository;
    private $tireLoadIndexRepository;
    private $tireSpeedRatingRepository;
    private $tireFuelEfficiencyRepository;
    private $tireWetGripRepository;
    private $tireNoiseLevelRepository;

    public function __construct(
        TireWidthRepository $tireWidthRepository,
        TireHeightRepository $tireHeightRepository,
        TireRimSizeRepository $tireRimSizeRepository,
        TireLoadIndexRepository $tireLoadIndexRepository,
        TireSpeedRatingRepository $tireSpeedRatingRepository,
        TireFuelEfficiencyRepository $tireFuelEfficiencyRepository,
        TireWetGripRepository $tireWetGripRepository,
        TireNoiseLevelRepository $tireNoiseLevelRepository
    )
    {
        $this->tireWidthRepository = $tireWidthRepository;
        $this->tireHeightRepository = $tireHeightRepository;
        $this->tireRimSizeRepository = $tireRimSizeRepository;
        $this->tireLoadIndexRepository = $tireLoadIndexRepository;
        $this->tireSpeedRatingRepository = $tireSpeedRatingRepository;
        $this->tireFuelEfficiencyRepository = $tireFuelEfficiencyRepository;
        $this->tireWetGripRepository = $tireWetGripRepository;
        $this->tireNoiseLevelRepository = $tireNoiseLevelRepository;
    }

    /**
     * @Route("/admin/tires/features", name="admin_tires_features")
     */
    public function list(Request $request)
    {
        $tireWidthForm = $this->createForm(TireWidthFormType::class);
        $tireHeightForm = $this->createForm(TireHeightFormType::class);
        $tireRimSizeForm = $this->createForm(TireRimSizeFormType::class);
        $tireLoadIndexForm = $this->createForm(TireLoadIndexFormType::class);
        $tireSpeedRatingForm = $this->createForm(TireSpeedRatingFormType::class);
        $tireFuelEfficiencyForm = $this->createForm(TireFuelEfficiencyFormType::class);
        $tireWetGripForm = $this->createForm(TireWetGripFormType::class);
        $tireNoiseLevelForm = $this->createForm(TireNoiseLevelFormType::class);

        $tireWidthForm->handleRequest($request);
        $this->formHandler($tireWidthForm);

        $tireHeightForm->handleRequest($request);
        $this->formHandler($tireHeightForm);

        $tireRimSizeForm->handleRequest($request);
        $this->formHandler($tireRimSizeForm);

        $tireLoadIndexForm->handleRequest($request);
        $this->formHandler($tireLoadIndexForm);

        $tireSpeedRatingForm->handleRequest($request);
        $this->formHandler($tireSpeedRatingForm);

        $tireFuelEfficiencyForm->handleRequest($request);
        $this->formHandler($tireFuelEfficiencyForm);

        $tireWetGripForm->handleRequest($request);
        $this->formHandler($tireWetGripForm);

        $tireNoiseLevelForm->handleRequest($request);
        $this->formHandler($tireNoiseLevelForm);

        return $this->render('admin/tires/features/list.html.twig', [
            'widthForm' => $tireWidthForm->createView(),
            'heightForm' => $tireHeightForm->createView(),
            'rimSizeForm' => $tireRimSizeForm->createView(),
            'loadIndexForm' => $tireLoadIndexForm->createView(),
            'speedRatingForm' => $tireSpeedRatingForm->createView(),
            'fuelEfficiencyForm' => $tireFuelEfficiencyForm->createView(),
            'noiseLevelForm' => $tireNoiseLevelForm->createView(),
            'wetGripForm' => $tireWetGripForm->createView(),
            'tiresWidth' => $this->tireWidthRepository->findAllAndSort(),
            'tiresHeight' => $this->tireHeightRepository->findAllAndSort(),
            'tiresRimSize' => $this->tireRimSizeRepository->findAllAndSort(),
            'tiresLoadIndex' => $this->tireLoadIndexRepository->findAllAndSort(),
            'tiresSpeedRating' => $this->tireSpeedRatingRepository->findAllAndSort(),
            'tiresFuelEfficiency' => $this->tireFuelEfficiencyRepository->findAllAndSort(),
            'tiresWetGrip' => $this->tireWetGripRepository->findAllAndSort(),
            'tiresNoiseLevel' => $this->tireNoiseLevelRepository->findAllAndSort()
        ]);
    }

    /**
     * @Route("/admin/tires/features/{feature}/{id}/delete", name="admin_tires_features_delete")
     */
    public function featureDeleter(string $feature, int $id): Response
    {
        // POTENTIALY DANGEROUS!!!
        $entity = "App\Entity\Tire\\$feature";
        $em = $this->getDoctrine()->getManager();

        try {
            $entity = $em->getRepository($entity)->find($id);
            $em->remove($entity);
            $em->flush();
        } catch (\Exception $e) {
            // todo
        }

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
