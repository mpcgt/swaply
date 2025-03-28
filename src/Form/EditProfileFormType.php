<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditProfileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $inputClass = 'form-control w-full p-3 bg-black text-white border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-700';
        $submitClass = 'w-full py-3 my-5 bg-indigo-500 text-white font-semibold rounded-3xl hover:bg-indigo-700 transition-all';

        $builder
            ->add('first_name', TextType::class, [
                'label' => 'Votre prénom',
                'attr' => ['class' => $inputClass],
            ])
            ->add('last_name', TextType::class, [
                'label' => 'Votre nom',
                'attr' => ['class' => $inputClass],
            ])
            ->add('username', TextType::class, [
                'label' => 'Votre nom d\'utilisateur',
                'attr' => ['class' => $inputClass],
            ])
            ->add('email', TextType::class, [
                'label' => 'Votre adresse e-mail',
                'attr' => ['class' => $inputClass],
            ])
            ->add('Submit', SubmitType::class, [
                'attr' => ['class' => $submitClass],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
