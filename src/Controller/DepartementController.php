<?php

namespace App\Controller;

use App\Entity\Departement;
use App\Form\DepartementType;
use App\Repository\DepartementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('IS_AUTHENTICATED_FULLY')]
#[Route('/admin/departement', name: 'app_departement.')]
class DepartementController extends AbstractController
{
    #[Route('/index', name: 'index', methods: ['GET'])]
    public function index(DepartementRepository $departementRepository): Response
    {
        return $this->render('departement/index.html.twig', [
            'departements' => $departementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'create', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $departement = new Departement();
        $form = $this->createForm(DepartementType::class, $departement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($departement);
            $entityManager->flush();

            return $this->redirectToRoute('app_departement.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('departement/new.html.twig', [
            'departement' => $departement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Departement $departement): Response
    {
        return $this->render('departement/show.html.twig', [
            'departement' => $departement,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Departement $departement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DepartementType::class, $departement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_departement.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('departement/edit.html.twig', [
            'departement' => $departement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Departement $departement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $departement->getId(), $request->request->get('_token'))) {
            $entityManager->remove($departement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_departement.index', [], Response::HTTP_SEE_OTHER);
    }
}
