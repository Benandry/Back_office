<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Contrat;
use App\Form\ContratType;
use App\Repository\ContratRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

#[Route('/contrat')]
class ContratController extends AbstractController
{
    #[Route('/index', name: 'app_contrat')]
    public function index(ContratRepository $repo): Response
    {
        return $this->render('contrat/index.html.twig', [
            'contrats' => $repo->findAll(),
        ]);
    }

    #[Route('/create', name: 'app_contrat_new')]
    public function create(Request $request, EntityManagerInterface $em): Response
    {

        $contrat = new Contrat();

        $form = $this->createForm(ContratType::class, $contrat);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($contrat);
            $em->flush();
            return $this->redirectToRoute('app_contrat');
        }

        return $this->render('contrat/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
