<?php

namespace App\Form\Tires;

use App\Entity\Tire\TireProduct;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TireProductFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('model', null, [
                'placeholder' => 'Choose model'
            ])
            ->add('price', null, [
                'attr' => ['placeholder' => 'Enter price']
            ])
            ->add('quantity', null, [
                'attr' => ['placeholder' => 'Enter quantity']
            ])
            ->add('year', null, [
                'attr' => ['placeholder' => 'Enter year']
            ])
            ->add('runOnFlat')
            ->add('reinforced')
            ->add('width', null, [
                'placeholder' => 'Choose width'
            ])
            ->add('height', null, [
                'placeholder' => 'Choose height'
            ])
            ->add('rimSize', null, [
                'placeholder' => 'Choose rim size'
            ])
            ->add('loadIndex', null, [
                'placeholder' => 'Choose load index'
            ])
            ->add('speedRating', null, [
                'placeholder' => 'Choose speed rating'
            ])
            ->add('noiseLevel', null, [
                'placeholder' => 'Choose noise level'
            ])
            ->add('fuelEfficiency', null, [
                'placeholder' => 'Choose fuel efficiency'
            ])
            ->add('wetGrip', null, [
                'placeholder' => 'Choose wet grip'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TireProduct::class,
        ]);
    }
}
