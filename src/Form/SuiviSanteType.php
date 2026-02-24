<?php

namespace App\Form;

use App\Entity\BilanSante;
use App\Entity\SuiviSante;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SuiviSanteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, [
                'label' => 'Date',
                'widget' => 'single_text',
            ])
            ->add('heuresSommeil', NumberType::class, [
                'label' => 'Heures de sommeil',
                'scale' => 1,
            ])
            ->add('qualiteSommeil', IntegerType::class, [
                'label' => 'Qualité Sommeil (1-10)',
                'attr' => ['min' => 1, 'max' => 10]
            ])
            ->add('verresEau', IntegerType::class, [
                'label' => 'Verres d\'eau',
                'attr' => ['min' => 0, 'max' => 30]
            ])
            ->add('minutesActivite', IntegerType::class, [
                'label' => 'Minutes d\'activité',
                'attr' => ['min' => 0, 'max' => 1440]
            ])
            ->add('activite', \Symfony\Component\Form\Extension\Core\Type\TextType::class, [
                'label' => 'Type d\'activité',
                'required' => false,
                'attr' => ['placeholder' => 'ex: Course, Yoga...']
            ])
            ->add('poids', NumberType::class, [
                'label' => 'Poids (kg)',
                'scale' => 1,
                'required' => false,
            ])
            ->add('humeur', IntegerType::class, [
                'label' => 'Humeur (1-10)',
                'attr' => ['min' => 1, 'max' => 10]
            ])
            ->add('notes', TextareaType::class, [
                'label' => 'Notes journalières',
                'required' => false,
                'attr' => ['rows' => 3]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SuiviSante::class,
        ]);
    }
}
