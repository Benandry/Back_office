<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
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
    #[Route('/admin/product', name: 'app_product_index')]
    public function indexProduct(): Response
    {
        return $this->render('admin/product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<img style="text-align:center;" src="https://t3.ftcdn.net/jpg/04/77/73/44/240_F_477734432_l1srDtzmuvtWUTkt6BVaRJ2mW2faXdTo.jpg"> Gestion de <span class="text-small">Voyageur</span>');
        // ->renderSidebarMinimized();
    }

    public function configureMenuItems(): iterable
    {
        // yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        return [
            // MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
            yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),

            // yield MenuItem::subMenu('Product', 'fa fa-article')->setSubItems([
            //     yield MenuItem::linkToDashboard('Product', 'fa fa-tags'),
            //     yield MenuItem::linkToDashboard('Product', 'fa fa-tags'),
            //     yield MenuItem::linkToDashboard('Product', 'fa fa-tags'),
            //     yield MenuItem::linkToDashboard('Product', 'fa fa-tags'),
            // ]),
            // yield MenuItem::section('Blog'),
            // yield MenuItem::linkToCrud('Categories', 'fa fa-tags', Product::class),
            // yield MenuItem::linkToCrud('Blog Posts', 'fa fa-file-text', BlogPost::class),
            // yield MenuItem::section('Users'),
            // yield MenuItem::linkToCrud('Comments', 'fa fa-comment', Comment::class),
            // yield MenuItem::linkToCrud('Users', 'fa fa-user', User::class),
        ];
    }
}
