<?php

namespace App\Controller;

use App\Entity\Staff;
use App\Form\StaffType;
use App\Repository\StaffRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/staff', name: 'app_staff.')]
class StaffController extends AbstractController
{
    #[Route('/index', name: 'index', methods: ['GET'])]
    public function index(StaffRepository $staffRepository): Response
    {
        return $this->render('staff/index.html.twig', [
            'staffs' => $staffRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'create', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $staff = new Staff();
        $form = $this->createForm(StaffType::class, $staff);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($staff);
            $entityManager->flush();

            return $this->redirectToRoute('app_staff.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('staff/new.html.twig', [
            'staff' => $staff,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Staff $staff): Response
    {
        return $this->render('staff/show.html.twig', [
            'staff' => $staff,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Staff $staff, EntityManagerInterface $entityManager): Response
    {
        dd($staff);
        $form = $this->createForm(StaffType::class, $staff);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_staff.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('staff/edit.html.twig', [
            'staff' => $staff,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Staff $staff, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $staff->getId(), $request->request->get('_token'))) {
            $entityManager->remove($staff);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_staff.index', [], Response::HTTP_SEE_OTHER);
    }
}
