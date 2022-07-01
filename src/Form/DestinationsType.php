<?php

namespace App\Form;

use App\Entity\Destinations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DestinationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('state')
            ->add('surname')
            ->add('picture')
            ->add('summary')
            ->add('extract')
            ->add('pros')
            ->add('created_at')
            ->add('updated_at')
            ->add('price_per_night')
            ->add('picture2')
            ->add('picture3')
            ->add('picture4')
            ->add('picture5')
            ->add('landscape')
            ->add('season')
            ->add('transport')
            ->add('tag')
            ->add('provider')
            ->add('user')
            ->add('nigth')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Destinations::class,
        ]);
    }
}
