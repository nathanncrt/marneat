<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username')
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('nomPers', null, [
                'empty_data' => null,
            ])
            ->add('pnomPers', null, [
                'empty_data' => null,
            ])
            ->add('dateNais', DateType::class, [
                    'widget' => 'single_text',

                    'empty_data' => '',
                ]
            )->add('emailPers', EmailType::class, [
                'empty_data' => null,
            ])
            ->add('telPers', TelType::class, [
                'required' => false,
                'empty_data' => '',
            ])
            ->add('cpPers', null, [
                'required' => false,
                'empty_data' => null,
            ])
            ->add('adrPers', null, [
                'required' => false,
                'empty_data' => null,
            ])
            ->add('villePers', null, [
                'required' => false,
                'empty_data' => null,
            ])
            ->add('avatar', FileType::class, [
                'required' => false,
                'empty_data' => null,
                'attr' => [
                    'accept' => 'image/png, image/jpeg',
            ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
