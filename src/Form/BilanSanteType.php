<?php

namespace App\Form;

use App\Entity\BilanSante;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Range;

class BilanSanteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateDebut', DateType::class, [
                'label' => 'Début Période',
                'widget' => 'single_text',
            ])
            ->add('dateFin', DateType::class, [
                'label' => 'Fin Période',
                'widget' => 'single_text',
            ])
            ->add('niveauFatigue', IntegerType::class, [
                'label' => 'Niveau Fatigue (1-10)',
                'constraints' => [new Range(['min' => 1, 'max' => 10])],
                'attr' => ['min' => 1, 'max' => 10]
            ])
            ->add('niveauStress', IntegerType::class, [
                'label' => 'Niveau Stress (1-10)',
                'constraints' => [new Range(['min' => 1, 'max' => 10])],
                'attr' => ['min' => 1, 'max' => 10]
            ])
            ->add('scoreForme', IntegerType::class, [
                'label' => 'Score Forme (1-10)',
                'constraints' => [new Range(['min' => 1, 'max' => 10])],
                'attr' => ['min' => 1, 'max' => 10]
            ])
            ->add('risqueBurnout', \Symfony\Component\Form\Extension\Core\Type\CheckboxType::class, [
                'label' => 'Risque de Burnout élevé ?',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BilanSante::class,
        ]);
    }
}
