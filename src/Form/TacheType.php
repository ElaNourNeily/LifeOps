<?php

namespace App\Form;

use App\Entity\Tache;
use App\Entity\TaskSpace;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TacheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class , [
            'label' => 'Titre',
            'attr' => ['placeholder' => 'Faire les courses...']
        ])
            ->add('description', TextareaType::class , [
            'label' => 'Description',
            'required' => false,
            'attr' => ['rows' => 3]
        ])
            ->add('priorite', ChoiceType::class , [
            'label' => 'Priorité',
            'choices' => [
                'Basse' => 1,
                'Moyenne' => 2,
                'Haute' => 3,
            ],
        ])
            ->add('statut', ChoiceType::class , [
            'label' => 'Statut',
            'choices' => [
                'À faire' => 'ToDo',
                'En cours' => 'InProgress',
                'En révision' => 'Review',
                'Terminé' => 'Done',
            ],
        ])
            ->add('difficulte', ChoiceType::class , [
            'label' => 'Difficulté (1-5)',
            'choices' => [
                '1 - Très facile' => 1,
                '2 - Facile' => 2,
                '3 - Moyenne' => 3,
                '4 - Difficile' => 4,
                '5 - Très difficile' => 5,
            ],
        ])
            ->add('deadline', DateTimeType::class , [
            'label' => 'Date limite',
            'widget' => 'single_text',
            'required' => false,
        ])
            ->add('estimatedTime', NumberType::class , [
            'label' => 'Temps estimé (h)',
            'required' => false,
        ])
            ->add('realTimeSpent', NumberType::class , [
            'label' => 'Temps passé (h)',
            'required' => false,
        ])
            ->add('assignedTo', EntityType::class , [
            'class' => Utilisateur::class ,
            'choice_label' => 'email',
            'label' => 'Assigner à',
            'required' => false,
            'placeholder' => 'Non assigné',
        ])
            ->add('taskSpace', EntityType::class , [
            'class' => TaskSpace::class ,
            'choice_label' => 'nom',
            'label' => 'Task Space',
            'required' => false,
            'placeholder' => 'Aucun Task Space',
        ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tache::class ,
        ]);
    }
}
