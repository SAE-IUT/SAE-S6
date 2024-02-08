<?php

namespace App\Controller\Admin;

use App\Entity\Emprunt;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use App\Repository\LivreRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class EmpruntCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Emprunt::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        $fields = [
            AssociationField::new('adherent'),
            DateField::new('dateEmprunt'),
            DateField::new('dateRetour'),

        ];
    
        if ($pageName === Crud::PAGE_NEW || $pageName === Crud::PAGE_EDIT) {
            $fields[] = AssociationField::new('livre')
            ->setFormTypeOption('query_builder', function (LivreRepository $entityRepository) {
                return $entityRepository->createQueryBuilder('e')
                    ->andWhere('NOT EXISTS(
                        SELECT 1
                        FROM App\Entity\Reservations r
                        WHERE r.livre = e.id
                    )')
                    ->andWhere('NOT EXISTS(
                        SELECT 1
                        FROM App\Entity\Emprunt em
                        WHERE em.livre = e.id
                    )')
                    ->orderBy('e.titre', 'ASC');
            });

        } else {
            $fields[] = AssociationField::new('livre');
            $fields[] = TextField::new('retard');
            
        }
        return $fields;
    }
    
}
