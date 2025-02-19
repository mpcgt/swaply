<?php

namespace App\Form;

use App\Entity\Products;
use App\Entity\Reviews;
use App\Entity\Users;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ReviewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {   
        $inputClass = 'form-control w-full p-3 bg-black text-white border border-gray-600 rounded-md';
        $submitClass = 'btn w-full py-3 mt-6 mb-3 bg-indigo-700 text-white font-semibold rounded-3xl hover:bg-indigo-700';

        $builder
            ->add('user', EntityType::class, [
                'class' => Users::class,
                'label' => 'Qui êtes-vous ?',
                'choice_label' => 'username',
                'attr' => ['class' => $inputClass],
            ])
            ->add('product', EntityType::class, [
                'class' => Products::class,
                'label' => 'Quelle produits choissisez-vous ?',
                'attr' => ['class' => $inputClass],
            ])
            ->add('rating', IntegerType::class, [
                'label' => 'Votre note (1-5 ⭐)',
                'attr' => ['class' => $inputClass],
            ])
            ->add('review_text', TextareaType::class, [
                'label' => 'Votre commentaire',
                'attr' => ['class' => $inputClass],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Créer',
                'attr' => ['class' => $submitClass],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reviews::class,
        ]);
    }
}
