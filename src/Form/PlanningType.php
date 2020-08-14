<?php

namespace App\Form;

use App\Entity\Planning;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PlanningType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('activity')
            ->add('day', ChoiceType::class, [
                'choices' => Planning::DAYS,
            ])
            ->add('hour', ChoiceType::class, [
                'choices' => Planning::HOURS,
            ])
            ->add('duration', ChoiceType::class, [
                'choices' => Planning::DURATION,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Planning::class,
        ]);
    }
}
