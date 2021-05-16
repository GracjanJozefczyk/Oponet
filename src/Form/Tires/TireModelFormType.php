<?php

namespace App\Form\Tires;

use App\Entity\Tire\TireModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TireModelFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'attr' => ['placeholder' => 'Enter name'],
            ])
            ->add('description')
            ->add('season', ChoiceType::class, [
                'choices' => TireModel::SEASONS,
                'placeholder' => 'Choose season'
            ])
            ->add('brand', null, [
                'placeholder' => 'Choose brand'
            ])
            ->add('vehicleType', null, [
                'placeholder' => 'Choose vehicle type'
            ])
            ->add('imagesUrls', CollectionType::class, [
                'entry_type' => HiddenType::class,
                'allow_delete' => true,
                'delete_empty' => true,
                'required' => false,
                'allow_add' => true,
                'prototype' => true,
                'prototype_data' => '__data__',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TireModel::class,
        ]);
    }
}
