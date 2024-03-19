<?php

namespace App\Form;

use App\Entity\Ustensile;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UstensilesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ustensile', EntityType::class, [
                'mapped' => false,
                'class' => Ustensile::class,
                'choice_label' => 'nomUs',
                'placeholder' => 'Ustensile',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ustensile::class,
        ]);
    }
}
