<?php

namespace App\Controller\Admin;

use App\Entity\TrainingType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TrainingTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TrainingType::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
