<?php

namespace App\Form;

use App\Entity\Products;
use App\Entity\Reviews;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ReviewsType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $inputClass = 'form-control w-full p-3 bg-black text-white border border-gray-600 rounded-md';
        $submitClass = 'btn w-full py-3 mt-6 mb-3 bg-indigo-700 text-white font-semibold rounded-3xl hover:bg-indigo-700';

        $builder
            ->add('product', EntityType::class, [
                'class' => Products::class,
                'label' => 'Quel produit choisissez-vous ?',
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

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $review = $event->getData();
            $review->setUser($this->security->getUser());
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reviews::class,
        ]);
    }
}
