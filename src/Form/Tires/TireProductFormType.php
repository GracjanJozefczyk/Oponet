<?php

namespace App\Form\Tires;

use App\Entity\Tire\TireFuelEfficiency;
use App\Entity\Tire\TireHeight;
use App\Entity\Tire\TireLoadIndex;
use App\Entity\Tire\TireNoiseLevel;
use App\Entity\Tire\TireProduct;
use App\Entity\Tire\TireRimSize;
use App\Entity\Tire\TireSpeedRating;
use App\Entity\Tire\TireWetGrip;
use App\Entity\Tire\TireWidth;
use App\Repository\Tire\TireFuelEfficiencyRepository;
use App\Repository\Tire\TireHeightRepository;
use App\Repository\Tire\TireLoadIndexRepository;
use App\Repository\Tire\TireNoiseLevelRepository;
use App\Repository\Tire\TireRimSizeRepository;
use App\Repository\Tire\TireSpeedRatingRepository;
use App\Repository\Tire\TireWetGripRepository;
use App\Repository\Tire\TireWidthRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TireProductFormType extends AbstractType
{
    private $tireSpeedRatingRepository;
    private $tireLoadIndexRepository;
    private $tireNoiseLevelRepository;
    private $tireFuelEfficiencyRepository;
    private $tireWetGripRepository;
    private $tireWidthRepository;
    private $tireHeightRepository;
    private $tireRimSizeRepository;

    public function __construct(
        TireSpeedRatingRepository $tireSpeedRatingRepository,
        TireLoadIndexRepository $tireLoadIndexRepository,
        TireNoiseLevelRepository $tireNoiseLevelRepository,
        TireFuelEfficiencyRepository $tireFuelEfficiencyRepository,
        TireWetGripRepository $tireWetGripRepository,
        TireWidthRepository $tireWidthRepository,
        TireHeightRepository $tireHeightRepository,
        TireRimSizeRepository $tireRimSizeRepository
    )
    {
        $this->tireSpeedRatingRepository = $tireSpeedRatingRepository;
        $this->tireLoadIndexRepository = $tireLoadIndexRepository;
        $this->tireNoiseLevelRepository = $tireNoiseLevelRepository;
        $this->tireFuelEfficiencyRepository = $tireFuelEfficiencyRepository;
        $this->tireWetGripRepository = $tireWetGripRepository;
        $this->tireWidthRepository = $tireWidthRepository;
        $this->tireHeightRepository = $tireHeightRepository;
        $this->tireRimSizeRepository = $tireRimSizeRepository;
    }

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
            ->add('width', EntityType::class, [
                'class' => TireWidth::class,
                'choices' => $this->tireWidthRepository->findAllAndSort(),
                'placeholder' => 'Choose width'
            ])
            ->add('height', EntityType::class, [
                'class' => TireHeight::class,
                'choices' => $this->tireHeightRepository->findAllAndSort(),
                'placeholder' => 'Choose height'
            ])
            ->add('rimSize', EntityType::class, [
                'class' => TireRimSize::class,
                'choices' => $this->tireRimSizeRepository->findAllAndSort(),
                'placeholder' => 'Choose rim size'
            ])
            ->add('loadIndex', EntityType::class, [
                'class' => TireLoadIndex::class,
                'choices' => $this->tireLoadIndexRepository->findAllAndSort(),
                'placeholder' => 'Choose load index',
            ])
            ->add('speedRating', EntityType::class, [
                'class' => TireSpeedRating::class,
                'choices' => $this->tireSpeedRatingRepository->findAllAndSort(),
                'placeholder' => 'Choose speed rating'
            ])
            ->add('noiseLevel', EntityType::class, [
                'class' => TireNoiseLevel::class,
                'choices' => $this->tireNoiseLevelRepository->findAllAndSort(),
                'placeholder' => 'Choose noise level'
            ])
            ->add('fuelEfficiency', EntityType::class, [
                'class' => TireFuelEfficiency::class,
                'choices' => $this->tireFuelEfficiencyRepository->findAllAndSort(),
                'placeholder' => 'Choose fuel efficiency'
            ])
            ->add('wetGrip', EntityType::class, [
                'class' => TireWetGrip::class,
                'choices' => $this->tireWetGripRepository->findAllAndSort(),
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
