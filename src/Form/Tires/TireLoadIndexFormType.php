<?php

namespace App\Form\Tires;

use App\Entity\Tire\TireLoadIndex;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TireLoadIndexFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('loadIndex')
            ->add('kg')
            ->add('lbs')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TireLoadIndex::class,
        ]);
    }
}
