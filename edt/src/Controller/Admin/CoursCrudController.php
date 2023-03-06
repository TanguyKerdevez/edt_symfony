<?php

namespace App\Controller\Admin;

use App\Entity\Cours;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class CoursCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cours::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            'type',
            DateTimeField::new('dateHeureDebut')->setFormat('Y-MM-dd HH:mm')->renderAsNativeWidget(),
            DateTimeField::new('dateHeureFin')->setFormat('Y-MM-dd HH:mm')->renderAsNativeWidget(),
            AssociationField::new('salle'),
            AssociationField::new('professeur'),
            AssociationField::new('matiere'),
        ];
    }
}
