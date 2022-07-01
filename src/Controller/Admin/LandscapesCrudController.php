<?php

namespace App\Controller\Admin;

use App\Entity\Landscapes;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class LandscapesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Landscapes::class;
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
