<?php

namespace App\Form;

use App\Entity\Budget;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BudgetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('mois', TextType::class, [
                'label' => 'Mois',
                'attr' => ['placeholder' => 'YYYY-MM']
            ])
            ->add('revenuMensuel', MoneyType::class, [
                'label' => 'Revenu Mensuel',
                'currency' => 'EUR',
            ])
            ->add('plafond', MoneyType::class, [
                'label' => 'Plafond Dépenses',
                'currency' => 'EUR',
            ])
            ->add('economies', MoneyType::class, [
                'label' => 'Objectif Épargne',
                'currency' => 'EUR',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Budget::class,
        ]);
    }
}
