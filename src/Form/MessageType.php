<?php

namespace App\Form;

use App\Entity\Message;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $message = $builder->getData();
        $builder
            // ->add('sender_id')
            ->add('user', EntityType::class, [
                'expanded' => true,
                'by_reference' => false,
                'class' =>User::class,
                'choice_label' => 'firstName',
                'choices' => $message->getEchange()->getTheme()->getUsers(),
            ])
            // ->add('createdAt')
            ->add('content', TextareaType::class);
            // ->add('echange')
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
