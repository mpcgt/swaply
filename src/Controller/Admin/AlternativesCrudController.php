<?php

namespace App\Controller\Admin;

use App\Entity\Alternatives;
use App\Entity\Tags;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AlternativesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Alternatives::class;
    }
    public function configureFields(string $pageName): iterable
    {
        ImageField::new('icon')
        ->setUploadDir('/assets/img/icons');

        return [
            IdField::new('id'),
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
            ImageField::new('icon')
                ->setUploadDir('public/assets/uploads/icons'),
            ImageField::new('cover')
                ->setUploadDir('public/assets/uploads/covers'),
            TextEditorField::new('advantage'),
            TextEditorField::new('incovenient'),
        ];
    }
}
