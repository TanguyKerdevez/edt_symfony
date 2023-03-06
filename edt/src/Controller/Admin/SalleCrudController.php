<?php

namespace App\Controller\Admin;

use App\Entity\Salle;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SalleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Salle::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            'numero',
            AssociationField::new('matieres')
                ->setFormTypeOptions([
                    'by_reference' => false,
                ]),
        ];
    }*/
    
}
