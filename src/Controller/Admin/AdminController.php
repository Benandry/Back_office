<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Entity\Staff;
use App\Form\StaffFormType;
use App\Repository\StaffRepository;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractDashboardController
{
    #[Route('/', name: 'admin')]
    public function index(): Response
    {
        $data = [
            "someColumn" => "someColumn",
            "anotherColumn" => "anotherColumn"
        ];
        return $this->render('admin/my-page.html.twig', [
            "my_own_data" => $data
        ]);

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }
    // #[Route('/admin/product', name: 'app_product_index')]
    #[Route('/admin/staff/index', name: 'app_staff_index')]
    public function indexStaff(StaffRepository $repository): Response
    {
        $staffs = $repository->findAllSatff();
        return $this->render('admin/staff/index.html.twig', [
            'staffs' => $staffs,
        ]);
    }

    #[Route('/admin/staff/create', name: 'app_staff_new')]
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

    #[Route('/admin/staff/edit/{id<\d+>}', name: 'app_staff_new')]
    public function editStaff(Request $request, EntityManagerInterface $em): Response
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

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<img style="text-align:center;" src="https://t3.ftcdn.net/jpg/04/77/73/44/240_F_477734432_l1srDtzmuvtWUTkt6BVaRJ2mW2faXdTo.jpg"> Gestion de <span class="text-small">RH</span>');
        // ->renderSidebarMinimized();
    }

    public function configureMenuItems(): iterable
    {
        // yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        return [
            // MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
            yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),


            yield MenuItem::section('STAFF', 'fa fa-user'),
            yield MenuItem::subMenu('RH', 'fa fa-comment')->setSubItems([
                MenuItem::linkToRoute('All staff', 'fa fa-users', 'app_staff_index'),
                MenuItem::linkToRoute('Nouveau', 'fa fa-user', 'app_staff_new'),
            ]),

            // yield MenuItem::linkToCrud('Blog Posts', 'fa fa-file-text', BlogPost::class),
            // yield MenuItem::section('Users'),
            // yield MenuItem::linkToCrud('Comments', 'fa fa-comment', Comment::class),
            // yield MenuItem::linkToCrud('Users', 'fa fa-user', User::class),
        ];
    }
}
