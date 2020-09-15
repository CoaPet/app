<?php

namespace App\Form;

use App\Entity\Activity;
use Symfony\Bundle\FrameworkBundle\Tests\Fixtures\Validation\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class ActivityType extends AbstractType
{
    const PICTOGRAMS = [
        'Haltère' => 'dumbbell',
        'Team training' => 'team',
        'Coaching à distance' => 'computer',
        'Gants de boxe' => 'box',
        'Corde à sauter' => 'jumping_rope',
        'Pilate' => 'pilate_women',
    ];

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('title', TextType::class, [
                'attr' => ['class' => "col-12"
                ]])

            ->add('description', CKEditorType::class, array('input_sync' => true))

            ->add('pictogram', ChoiceType::class, [
                'choices' => self::PICTOGRAMS,
                'required'   => false,
            ])

            ->add('activityFile', VichImageType::class, [
                'required' => false,
                'help'=> 'le fichier ne doit pas dépasser '. Activity::MAX_SIZE,
                'allow_delete' => true,
                'download_uri' => true,
                'download_link' => false,
                'delete_label'  => 'Supprimer cette image',
            ])

            ->add('category', ChoiceType::class, ['choices' => Activity::CATEGORY])

            ->add('focus')

            ->add('intensity')

            ->add('maxparticipation')

            ->add('more')

            ->add('coachsentence');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Activity::class,
        ]);
    }
}
