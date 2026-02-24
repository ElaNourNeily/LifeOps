<?php

namespace App\Form;

use App\Entity\TaskSpace;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskSpaceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom du projet',
                'attr'  => ['placeholder' => 'Ex: Refonte du site web'],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr'  => ['placeholder' => 'Décrivez l\'objectif du projet...', 'rows' => 4],
            ])
            ->add('type', ChoiceType::class, [
                'label'   => 'Type de projet',
                'choices' => [
                    'Développement' => 'development',
                    'Design'        => 'design',
                    'Marketing'     => 'marketing',
                    'Recherche'     => 'research',
                    'Autre'         => 'other',
                ],
            ])
            ->add('Duration', IntegerType::class, [
                'label' => 'Durée (en jours)',
                'attr'  => ['min' => 1, 'max' => 365],
                'data'  => 14,
            ])
            ->add('status', ChoiceType::class, [
                'label'   => 'Statut du projet',
                'choices' => [
                    'Actif'    => 'active',
                    'En pause' => 'paused',
                    'Terminé'  => 'completed',
                    'Archivé'  => 'archived',
                ],
                'data' => 'active',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TaskSpace::class,
        ]);
    }
}