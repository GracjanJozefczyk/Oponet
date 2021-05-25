<?php


namespace App\Controller\Store\Profile;


use App\Entity\User\User;
use App\Form\Users\EditProfileFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="show_profile")
     */
    public function showProfile()
    {
        return $this->render('store/profile/profile.html.twig');
    }

    /**
     * @Route("/profile/{id}/edit", name="edit_profile")
     */
    public function editProfile(User $user, EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(EditProfileFormType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('show_profile');
        }

        return $this->render('store/profile/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}