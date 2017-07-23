<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
//use Symfony\Component\Form\Extension\Core\Type\FileType;

class FileType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('file', \Symfony\Component\Form\Extension\Core\Type\FileType::class)
//                ->add('path')
//                ->add('fileName')
                ->add('type')
//                ->add('added')
                ->add('date', TextType::class, ['attr' => ['class' => 'span11', 'data-date-format' => "dd/mm/yyyy"],'required'=>false])
                ->add('additionalInfo')
                ->add('business', HiddenType::class)
                ->add('individual', HiddenType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\File'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_file';
    }


}
