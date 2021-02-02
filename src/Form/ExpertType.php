<?php

namespace App\Form;

use App\Entity\Expert;
use App\Entity\Theme;
use App\Entity\User;
use App\Controller\admin\ThemeController;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;


class ExpertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('profession', TextType::class, [
                'mapped'=>false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a profession',
                    ]),
            ]])
            ->add('theme', EntityType::class, [
                'expanded' => true,
                'multiple' => true,
                'by_reference' => false,
                'class' =>Theme::class,
                'choice_label' => 'name'
            ])

            // ->add('new', ThemeController::class, [
            //     'class' => Theme::class,
            // ])
            ->add('numeroSIRET', TextType::class, [
                'mapped'=>false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your SIRET number',
                    ]),            
            ]])
            ->add('address', TextType::class, [
                'mapped'=>false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your address',
                    ]),            
            ]])
            ->add('postal_code', TextType::class, [
                'mapped'=>false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your postale code',
                    ]),            
            ]])
            ->add('city', TextType::class, [
                'mapped'=>false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your city',
                    ]),            
            ]])
            ->add('email')
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
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
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
