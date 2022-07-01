<?php

namespace App\Controller\Admin;

use App\Entity\Transports;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TransportsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Transports::class;
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
