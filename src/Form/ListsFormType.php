<?php

namespace App\Form;

use App\Entity\Lists;
use App\Entity\Products;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ListsFormType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('cover', FileType::class, [
                'label' => 'Fichier de couverture (JPEG ou PNG)',
                'mapped' => false,
            ])
            ->add('date', null, [
                'widget' => 'single_text',
            ])
            ->add('products', EntityType::class, [
                'class' => Products::class,
                'choice_label' => 'title',
                'multiple' => true,
            ]);

            // $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            //     $list = $event->getData();
            //     $list->setUser($this->security->getUser());
            // });
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Lists::class,
        ]);
    }
}
