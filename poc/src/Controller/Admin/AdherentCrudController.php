<?php

namespace App\Controller\Admin;

use App\Entity\Adherent;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class AdherentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Adherent::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('dateAdhesion')->setFormTypeOption('widget', 'single_text'),
            TextField::new('nom'),
            TextField::new('prenom'),
            DateField::new('dateNaiss'),
            TextField::new('email'),
            IntegerField::new('adressePostale'),
            IntegerField::new('numTel'),
            TextField::new('photo'),

        ];
    }

}
