<?php

namespace App\Controller\Admin;

use App\Entity\Seasons;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SeasonsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Seasons::class;
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
