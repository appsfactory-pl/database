<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class IndividualType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('id2')
                ->add('title')
                ->add('forename')
                ->add('middlename')
                ->add('lastname')
                ->add('maidenname')
                ->add('dob', TextType::class, ['attr' => ['class' => 'span11', 'data-date-format' => "dd/mm/yyyy"]])
                ->add('phone')
                ->add('phone2')
                ->add('email', EmailType::class)
                ->add('address')
                ->add('postcode')
                ->add('nin')
                ->add('utr')
                ->add('notes', TextareaType::class, ['attr' => ['class' => 'textarea_editor span12']])
                ->add('notesChildren', TextareaType::class, ['attr' => ['class' => 'textarea_editor span12']])
                ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Individual'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_individual';
    }


}
