<?php

namespace App\Form;

use App\Entity\Activite;
use App\Entity\Planning;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActiviteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre de l\'activité',
                'attr' => ['placeholder' => 'Réunion, Sport...']
            ])
            ->add('heureDebutEstimee', TimeType::class, [
                'label' => 'Heure de début',
                'widget' => 'single_text',
            ])
            ->add('heureFinEstimee', TimeType::class, [
                'label' => 'Heure de fin',
                'widget' => 'single_text',
            ])
            ->add('categorie', ChoiceType::class, [
                'label' => 'Catégorie',
                'choices' => [
                    'Travail' => 'Travail',
                    'Personnel' => 'Personnel',
                    'Urgent' => 'Urgent',
                    'Loisir' => 'Loisir',
                    'Santé' => 'Santé',
                ],
                'placeholder' => 'Sélectionner une catégorie',
            ])
            ->add('couleur', ChoiceType::class, [
                'label' => 'Couleur',
                'choices' => [
                    'Emeraude' => '#10b981',
                    'Bleu' => '#3b82f6',
                    'Orange' => '#f59e0b',
                    'Rose' => '#ec4899',
                    'Violet' => '#8b5cf6',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('priorite', ChoiceType::class, [
                'label' => 'Priorité',
                'choices' => [
                    'Basse' => 1,
                    'Moyenne' => 2,
                    'Haute' => 3,
                ],
            ])
            ->add('niveauUrgence', RangeType::class, [
                'label' => 'Urgence (1-5)',
                'attr' => ['min' => 1, 'max' => 5],
            ])
            ->add('etat', ChoiceType::class, [
                'label' => 'Statut',
                'choices' => [
                    'À faire' => 'todo',
                    'En cours' => 'in-progress',
                    'Terminé' => 'done',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Activite::class,
        ]);
    }
}
