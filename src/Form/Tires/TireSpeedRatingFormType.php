<?php

namespace App\Form\Tires;

use App\Entity\Tire\TireSpeedRating;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TireSpeedRatingFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('speedRating')
            ->add('kmh')
            ->add('mph')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TireSpeedRating::class,
        ]);
    }
}
