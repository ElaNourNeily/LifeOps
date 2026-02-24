<?php

namespace App\Form;

use App\Entity\Budget;
use App\Entity\Depense;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DepenseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre',
                'attr' => ['placeholder' => 'Courses, Loyer...']
            ])
            ->add('montant', MoneyType::class, [
                'label' => 'Montant',
                'currency' => 'EUR',
            ])
            ->add('categorie', ChoiceType::class, [
                'label' => 'Catégorie',
                'choices' => [
                    'Logement' => 'logement',
                    'Nourriture' => 'nourriture',
                    'Transport' => 'transport',
                    'Loisirs' => 'loisirs',
                    'Santé' => 'sante',
                    'Autre' => 'autre',
                ],
            ])
            ->add('date', DateTimeType::class, [
                'label' => 'Date',
                'widget' => 'single_text',
            ])
            ->add('typePaiement', ChoiceType::class, [
                'label' => 'Moyen de paiement',
                'choices' => [
                    'Carte Bancaire' => 'carte',
                    'Espèces' => 'especes',
                    'Virement' => 'virement',
                    'Prélèvement' => 'prelevement',
                ],
            ])
            ->add('budget', EntityType::class, [
                'class' => Budget::class,
                'choice_label' => 'mois',
                'label' => 'Budget associé',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Depense::class,
        ]);
    }
}
