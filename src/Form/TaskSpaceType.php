<?php

namespace App\Form;

use App\Entity\TaskSpace;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            ->add('nom', TextType::class , [
            'label' => 'Nom du projet',
            'attr' => ['placeholder' => 'Ex: Projet Alpha']
        ])
            ->add('description', TextareaType::class , [
            'label' => 'Description',
            'required' => false,
            'attr' => ['rows' => 3]
        ])
            ->add('sprintDuration', IntegerType::class , [
            'label' => 'Durée du tache (jours)',
            'data' => 14
        ])
            ->add('status', ChoiceType::class , [
            'label' => 'Statut',
            'choices' => [
                'Actif' => 'Active',
                'Archivé' => 'Archived',
            ],
        ])
            ->add('members', EntityType::class , [
            'class' => Utilisateur::class ,
            'choice_label' => 'email',
            'multiple' => true,
            'expanded' => false,
            'label' => 'Membres du projet',
            'required' => false,
            'attr' => ['class' => 'select2']
        ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TaskSpace::class ,
        ]);
    }
}
