<?php

namespace App\Form;

use App\Entity\Badge;
use App\Entity\Category;
use App\Entity\Products;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('icon', FileType::class, [
                'label' => 'Fichier d\'icône(JPEG ou PNG)',
                'mapped' => false,
            ])
            ->add('cover', FileType::class, [
                'label' => 'Fichier de couverture (JPEG ou PNG)',
                'mapped' => false,
            ])
            ->add('title')
            ->add('description')
            ->add('website')
            ->add('github')
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'id',
            ])
            ->add('badge', EntityType::class, [
                'class' => Badge::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ]);
    }
}
