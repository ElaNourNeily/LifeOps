<?php

namespace App\Form;

use App\Entity\Feedback;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

class FeedbackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type_feedback', ChoiceType::class, [
                'label' => 'Type de retour',
                'choices' => [
                    'Bogue / Erreur' => 'bug',
                    'Suggestion' => 'suggestion',
                    'Question' => 'question',
                    'Autre' => 'autre',
                ],
                'attr' => ['class' => 'bg-background border-border rounded-lg w-full px-4 py-2 focus:ring-2 focus:ring-primary/20 transition-all'],
                'label_attr' => ['class' => 'block text-sm font-medium mb-1 text-card-foreground'],
            ])
            ->add('module_cible', ChoiceType::class, [
                'label' => 'Module concerné',
                'choices' => [
                    'Global' => 'global',
                    'Santé' => 'sante',
                    'Finances' => 'finances',
                    'Tâches' => 'taches',
                    'Objectifs' => 'objectifs',
                    'Temps' => 'temps',
                ],
                'attr' => ['class' => 'bg-background border-border rounded-lg w-full px-4 py-2 focus:ring-2 focus:ring-primary/20 transition-all'],
                'label_attr' => ['class' => 'block text-sm font-medium mb-1 text-card-foreground'],
            ])
            ->add('note', HiddenType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez donner une note.']),
                    new Range([
                        'min' => 1,
                        'max' => 5,
                        'notInRangeMessage' => 'La note doit être entre {{ min }} et {{ max }}.',
                    ]),
                ],
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Votre message',
                'attr' => [
                    'rows' => 5,
                    'placeholder' => 'Dites-nous ce que vous en pensez...',
                    'class' => 'bg-background border-border rounded-lg w-full px-4 py-2 focus:ring-2 focus:ring-primary/20 transition-all resize-none',
                ],
                'label_attr' => ['class' => 'block text-sm font-medium mb-1 text-card-foreground'],
                'constraints' => [
                    new NotBlank(['message' => 'Le message ne peut pas être vide.']),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Feedback::class,
        ]);
    }
}
