<?php

namespace App\Controller\Admin;

use App\Entity\Destinations;
use App\Entity\Landscapes;
use App\Entity\Seasons;
use App\Entity\Transports;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
        // return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
        
            // you can include HTML contents too (e.g. to link to an image)
            ->setTitle('☀️\'Travel Back')

            // the domain used by default is 'messages'
            ->setTranslationDomain('my-custom-domain')

            // set this option if you prefer the page content to span the entire
            // browser width, instead of the default design which sets a max width
            ->renderContentMaximized()

            // by default, all backend URLs include a signature hash. If a user changes any
            // query parameter (to "hack" the backend) the signature won't match and EasyAdmin
            // triggers an error. If this causes any issue in your backend, call this method
            // to disable this feature and remove all URL signature checks
            ->disableUrlSignatures()

            // by default, all backend URLs are generated as absolute URLs. If you
            // need to generate relative URLs instead, call this method
            ->generateRelativeUrls()
            ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Listes des destinations', 'fas fa-list', Destinations::class);
        yield MenuItem::linkToCrud('Liste des user', 'fas fa-list', User::class);
        yield MenuItem::linkToCrud('Liste des transports', 'fas fa-list', Transports::class);
        yield MenuItem::linkToCrud('Liste des saisons', 'fas fa-list', Seasons::class);
        yield MenuItem::linkToCrud('Liste des paysages', 'fas fa-list', Landscapes::class);
    }
}
