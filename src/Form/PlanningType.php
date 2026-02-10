<?php

namespace App\Form;

use App\Entity\Planning;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlanningType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['readonly' => !$options['is_new']],
                'label' => 'Date du planning'
            ])
            ->add('heure_debut_journee', TimeType::class, [
                'widget' => 'single_text',
                'label' => 'Heure de début de journée'
            ])
            ->add('heure_fin_journee', TimeType::class, [
                'widget' => 'single_text',
                'label' => 'Heure de fin de journée'
            ])
            ->add('disponibilite', CheckboxType::class, [
                'label' => 'Disponible pour cette journée',
                'required' => false,
            ])
            ->add('activites', CollectionType::class, [
                'entry_type' => ActiviteType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Planning::class,
            'is_new' => false,
        ]);
    }
}
