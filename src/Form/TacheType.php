<?php

namespace App\Form;

use App\Entity\Tache;
use App\Entity\TaskSpace;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

class TacheType extends AbstractType
{
    public function __construct(
        private readonly TokenStorageInterface $tokenStorage
    ) {}

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $this->tokenStorage->getToken()?->getUser();

        $builder
            ->add('titre', TextType::class, [
                'label'       => 'Titre',
                'attr'        => ['placeholder' => 'Nom de la tâche'],
                'constraints' => [
                    new NotBlank(['message' => 'Le titre est obligatoire.']),
                    new Length(['max' => 255]),
                ],
            ])
            ->add('priorite', ChoiceType::class, [
                'label'   => 'Priorité',
                'choices' => [
                    'Basse'  => 'low',
                    'Moyenne' => 'medium',
                    'Haute'  => 'high',
                ],
            ])
            ->add('statut', ChoiceType::class, [
                'label'   => 'Statut',
                'choices' => [
                    'À faire'      => 'todo',
                    'En cours'     => 'in-progress',
                    'En révision'  => 'review',
                    'Terminé'      => 'done',
                ],
            ])
            ->add('difficulte', IntegerType::class, [
                'label'       => 'Difficulté (1–5)',
                'attr'        => ['min' => 1, 'max' => 5, 'placeholder' => '1'],
                'constraints' => [new Range(['min' => 1, 'max' => 5])],
            ])
            ->add('deadline', DateTimeType::class, [
                'label'    => 'Date limite',
                'required' => false,
                'widget'   => 'single_text',
            ])
            ->add('taskSpace', EntityType::class, [
                'label'        => 'Projet (TaskSpace)',
                'class'        => TaskSpace::class,
                'choice_label' => 'nom',
                'required'     => false,
                'placeholder'  => '— Aucun projet (Solo) —',
                // Filter to only show TaskSpaces owned by the current user
                'query_builder' => function (\Doctrine\ORM\EntityRepository $er) use ($user) {
                    return $er->createQueryBuilder('ts')
                        ->where('ts.utilisateur = :user')
                        ->andWhere('ts.status = :status')
                        ->setParameter('user', $user)
                        ->setParameter('status', 'Active')
                        ->orderBy('ts.nom', 'ASC');
                },
            ])
            ->add('description', TextareaType::class, [
                'label'    => 'Description',
                'required' => false,
                'attr'     => ['rows' => 4, 'placeholder' => 'Décrivez la tâche...'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tache::class,
        ]);
    }
}