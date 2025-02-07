<?php

namespace App\Controller\Admin;

use App\Entity\Products;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Products::class;
    }

    public function configureFields(string $pageName): iterable
    {
        ImageField::new('icon')
        ->setUploadDir('/assets/img/icons');

        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
            TextEditorField::new('website'),
            TextEditorField::new('github'),
            ImageField::new('icon'),
            ImageField::new('cover'),

        ];
    }
}
