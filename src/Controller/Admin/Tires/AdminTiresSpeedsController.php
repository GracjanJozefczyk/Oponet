<?php


namespace App\Controller\Admin\Tires;

use App\Form\TireSpeedFormType;
use App\Repository\TireSpeedRatingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminTiresSpeedsController extends AbstractController
{
    /**
     * @Route("/admin/tires/speed", name="admin_tires_speed")
     */
    public function list(TireSpeedRatingRepository $tireSpeedRatingRepository): Response
    {
        $speeds = $tireSpeedRatingRepository->findAll();

        return $this->render('admin/tires/speed/list.html.twig', [
            'speeds' => $speeds
        ]);
    }

    /**
     * @Route("/admin/tires/speed/new", name="admin_tires_speed_new")
     */
    public function new(EntityManagerInterface $em, Request $request): Response
    {
        $form = $this->createForm(TireSpeedFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $speed = $form->getData();

            $em->persist($speed);
            $em->flush();

            return $this->redirectToRoute('admin_tires_speed');
        }
        return $this->render('admin/tires/speed/new.html.twig', [
            'speedForm' => $form->createView()
        ]);
    }

}