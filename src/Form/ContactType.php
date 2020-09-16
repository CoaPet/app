<?php

namespace App\Form;

use Libs\RecaptchaBundle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Contact;
use Symfony\Component\Validator\Constraints\Choice;

class ContactType extends AbstractType
{
    const ITEMS = [
        'Coaching' => 'Coaching',
        'Team training' => 'Team training',
        'Coaching à distance' => 'Coaching à distance',
    ];
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => ['class' => "w-100 mb-3 p-3", 'placeholder' => "Benjamin Button"],
                'label' => 'Nom & Prénom',
            ])

            ->add('phone', TextType::class, [
                'attr' => ['class' => "w-100 p-3", 'placeholder' => "0687654321"],
                'label' => 'Numéro de téléphone',
                'help' => "Votre numéro de téléphone doit être composé de 10 chiffres seulement.",
            ])
            ->add('birthDate', IntegerType::class, [
                'attr' => ['class' => "w-100 p-3", 'placeholder' => "35"],
                'label' => 'Âge',
                'help' => "Veuillez entrer votre âge en chiffre uniquement.",
            ])
            ->add('email', EmailType::class, [
                'attr' => ['class' => "w-100 p-3", 'placeholder' => "benjamin.button@gmail.com"],
                'label' => 'Adresse Email',
                'help' => "Veuillez entrer une adresse e-mail valide.",
            ])
            ->add('items', ChoiceType::class, [
                'choices' => self::ITEMS,
                'attr' => ['class' => "w-100 p-1 mb-4"],
                'label' => 'Thème',
            ])
            ->add('message', TextareaType::class, [
                'attr' => ['class' => "w-100 p-3",
                    'placeholder' =>
                        "Je suis intéressé par votre programme. Auriez-vous plus d'informations à me communiquer ?"],
                'label' => 'Message',
                'help' => "Votre message doit être composé de 20 caractères minimum.",
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
