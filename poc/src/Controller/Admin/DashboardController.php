<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Adherent;
use App\Entity\Auteur;
use App\Entity\Categorie;
use App\Entity\Emprunt;
use App\Entity\Livre;
use App\Entity\Reservations;
use App\Entity\Utilisateur;


class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Poc Bibliotheque');
    }

    public function configureMenuItems(): iterable
    {
            yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
            yield MenuItem::section('Catalogue');
            yield MenuItem::linkToCrud('Adherent', 'fa fa-folder', Adherent::class);
            yield MenuItem::linkToCrud('Auteur', 'fa fa-file-text', Auteur::class);
            yield MenuItem::linkToCrud('Categorie', 'fa fa-file-text', Categorie::class);
    
            yield MenuItem::linkToCrud('Emprunt', 'fa fa-file-text', Emprunt::class);
            yield MenuItem::linkToCrud('Livre', 'fa fa-file-text', Livre::class);
            yield MenuItem::linkToCrud('Reservations', 'fa fa-file-text', Reservations::class);
            yield MenuItem::section('Configuration');

            
    }
}

