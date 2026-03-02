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
                'choices' => [
                    'Alimentation' => 'alimentation',
                    'Logement' => 'logement',
                    'Transport' => 'transport',
                    'Loisirs' => 'loisirs',
                    'Santé' => 'sante',
                    'Éducation' => 'education',
                    'Autre' => 'autre',
                ],
                'label' => 'Catégorie',
                'attr' => ['class' => 'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']
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
            ->add('receiptImage', \Symfony\Component\Form\Extension\Core\Type\FileType::class, [
                'label' => 'Image du reçu (Optionnel)',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new \Symfony\Component\Validator\Constraints\File([
                        'maxSize' => '5M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/webp',
                        ],
                        'mimeTypesMessage' => 'Veuillez uploader une image valide (JPG, PNG, WEBP)',
                    ])
                ],
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
