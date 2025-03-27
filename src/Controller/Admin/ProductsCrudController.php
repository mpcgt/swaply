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
        // Configuration du champ 'icon' pour l'image de l'icône.
        // Définit le répertoire où les images seront téléchargées.
        ImageField::new('icon')
        ->setUploadDir('/assets/img/icons');

        // Retourne un tableau de configurations de champs.
        return [
            IdField::new('id'),
            IdField::new('id_products'),
            IdField::new('id_category'),
            IdField::new('id_badge'),
            TextField::new('title'),
            TextEditorField::new('description'),
            TextEditorField::new('website'),
            TextEditorField::new('github'),
            ImageField::new('icon')
                ->setUploadDir('public/assets/uploads/icons'),
            ImageField::new('cover')
                ->setUploadDir('public/assets/uploads/covers')   
                ->setRequired(false),

        ];
    }
}
