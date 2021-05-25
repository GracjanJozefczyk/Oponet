<?php


namespace App\Controller\Admin\Users;


use App\Repository\User\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminUsersController extends AbstractController
{
    /**
     * @Route("/admin/users/customers/", name="admin_customers")
     */
    public function customers(UserRepository $userRepository)
    {
        $customers = $userRepository->findAllEmployees();

        return $this->render('admin/users/customers.html.twig', [
            'customers' => $customers
        ]);
    }

    /**
     * @Route("/admin/users/employees/", name="admin_employees")
     */
    public function employees()
    {
        return $this->render('admin/users/employees.html.twig');
    }

}