<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Regex;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                    'empty_data' => '',
                ]
            )
            ->add('nomPers', TextType::class, [
                    'empty_data' => '',
                ]
            )
            ->add('pnomPers', TextType::class, [
                    'empty_data' => '',
                ]
            )
            ->add('dateNais', DateType::class, [
                    'widget' => 'single_text',

                    'empty_data' => '',
                ]
            )
            ->add('emailPers', EmailType::class, [
                    'empty_data' => '',
                ]
            )
            ->add('telPers', TelType::class, [
                    'required' => false,
                ]
            )
            ->add('cpPers', TextType::class, [
                    'required' => false,
                    'constraints' => [
                    new Regex([
                        'pattern' => '/^\d{5}$/',
                        'message' => 'Veuillez entrer un code postal à 5 chiffres.',
        ]),
    ],
    'attr' => [
        'maxlength' => 5,
        'minlength' => 5,
    ],
                ]
            )
            ->add('adrPers', TextType::class, [
                    'required' => false,
                ]
            )
            ->add('villePers', TextType::class, [
                    'required' => false,
                ]
            )
            ->add('avatar', FileType::class, [
                'label' => 'Avatar (png file)',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '5000k',
                        'mimeTypes' => [
                            'image/*',
                        ],
                        'mimeTypesMessage' => 'Veuillez rentrer une image.',
                    ]),
                ]])

            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
