<?php

namespace App\Controller\Admin;

use App\Entity\Staff;
use App\Form\StaffFormType;
use App\Repository\StaffRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/staff')]
class StaffController extends AbstractController
{
    #[Route('/index', name: 'app_staff_index')]
    public function indexStaff(StaffRepository $repository): Response
    {
        $staffs = $repository->findAllSatff();
        return $this->render('admin/staff/index.html.twig', [
            'staffs' => $staffs,
        ]);
    }

    #[Route('/create', name: 'app_staff_new')]
    public function createStaff(Request $request, EntityManagerInterface $em): Response
    {

        $staff = new Staff();
        $form = $this->createForm(StaffFormType::class, $staff);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($staff);
            $em->flush();
            return $this->redirectToRoute('app_staff_index');
        }

        return $this->renderForm('admin/staff/new.html.twig', [
            'form' => $form,
        ]);
    }
}
