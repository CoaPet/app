<?php

namespace App\Form;

use App\Entity\InfoCoach;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\DomCrawler\Field\TextareaFormField;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class InfoCoachType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('phone')
            ->add('mail')
            ->add('adress')
            ->add('zipCode')
            ->add('city')
            ->add('catchline', TextareaType::class, [
                'attr' => ['class'=>"col-12 form-h-1"
                ]])
            ->add('imageFile', VichFileType::class, [
                'label' => 'Image à télécharger',
                'required' => false,
                'allow_delete' => false,
                'download_uri' => false,
                'help'=> 'le fichier ne doit pas dépasser '. InfoCoach::MAX_SIZE,
            ])

            ->add('planningFile', VichFileType::class, [
                'label' => 'Ajoutez votre planning',
                'required' => false,
                'allow_delete' => false,
                'download_uri' => false,
            ])

            ->add('philosophy', CKEditorType::class, [
                'input_sync' => true,
                'attr' => ['class'=>"col-12 form-h-1"
                ]])
            ->add('presentation', CKEditorType::class, [
                'input_sync' => true,
                'attr' => ['class'=>"col-12 form-h-3"
                ]])
            ->add('quality', CKEditorType::class, [
                'input_sync' => true,
                'attr' => ['class'=>"col-12 form-h-3"
                ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => InfoCoach::class,
        ]);
    }
}
