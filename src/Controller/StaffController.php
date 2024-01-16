<?php

namespace App\Controller;

use App\Entity\Staff;
use App\Form\StaffType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/staff')]
class StaffController extends AbstractController
{
    #[Route('/index', name: 'app_staff')]
    public function index(): Response
    {
        return $this->render('staff/index.html.twig', [
            'controller_name' => 'StaffController',
        ]);
    }

    #[Route('/create', name: 'app_staff_create')]
    public function create(Request $request): Response
    {
        $staff = new Staff();

        $form = $this->createForm(StaffType::class, $staff);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            echo 'pass ';
        }

        return $this->render('staff/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
