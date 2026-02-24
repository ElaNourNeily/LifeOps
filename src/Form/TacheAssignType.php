<?php

namespace App\Form;

use App\Entity\Tache;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class TacheAssignType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $members = $options['members'];

        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre de la tâche',
                'attr'  => ['placeholder' => 'Ex: Créer la page d\'accueil'],
                'constraints' => [new NotBlank()],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => false,
                'attr'  => ['placeholder' => 'Décrivez la tâche en détail...', 'rows' => 4],
            ])
            ->add('utilisateur', EntityType::class, [
                'label'        => 'Assigner à',
                'class'        => Utilisateur::class,
                'choices'      => $members,
                'choice_label' => fn(Utilisateur $u) => $u->getPrenom() . ' ' . $u->getNom(),
                'placeholder'  => '— Choisir un membre —',
                'constraints'  => [new NotBlank(['message' => 'Veuillez choisir un membre.'])],
            ])
            ->add('priorite', ChoiceType::class, [
                'label'   => 'Priorité',
                'choices' => [
                    'Basse'   => 'low',
                    'Moyenne' => 'medium',
                    'Haute'   => 'high',
                    'Urgente' => 'urgent',
                ],
            ])
            ->add('difficulte', IntegerType::class, [
                'label' => 'Difficulté (1–5)',
                'attr'  => ['min' => 1, 'max' => 5],
                'data'  => 3,
            ])
            ->add('statut', ChoiceType::class, [
                'label'   => 'Statut initial',
                'choices' => [
                    'À faire'       => 'todo',
                    'En cours'      => 'in-progress',
                    'En révision'   => 'review',
                    'Terminé'       => 'done',
                ],
                'data' => 'todo',
            ])
            ->add('deadline', DateTimeType::class, [
                'label'    => 'Deadline',
                'required' => false,
                'widget'   => 'single_text',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tache::class,
            'members'    => [],
        ]);
    }
}