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
                ->add('status')
                ->add('title')
                ->add('forename')
                ->add('middlename')
                ->add('lastname')
                ->add('maidenname')
                ->add('dob', TextType::class, ['attr' => ['class' => 'span11', 'data-date-format' => "dd/mm/yyyy"]])
                ->add('phone')
                ->add('phone2')
                ->add('maritialStatus')
                ->add('email', EmailType::class)
                ->add('address', TextType::class, ['attr' => [],'required'=>true])
                ->add('postcode', TextType::class, ['attr' => [],'required'=>true])
                ->add('dateMovedIn', TextType::class, ['attr' => ['class' => 'span11', 'data-date-format' => "dd/mm/yyyy"]])
                ->add('nin')
                ->add('utr')
                ->add('bankAccountDetails')
                ->add('eSignaturePassword')
                ->add('notes', TextareaType::class, ['attr' => ['class' => 'textarea_editor span12'],'required'=>false])
                ->add('dateDisengaged', TextType::class, ['attr' => ['class' => 'span11', 'data-date-format' => "dd/mm/yyyy"],'required'=>false])
                ->add('disengegementReason')
                ->add('archived', TextType::class, ['attr' => ['class' => 'span11', 'data-date-format' => "dd/mm/yyyy"],'required'=>false])
                ->add('archiveNumber')
                ->add('archiveNote')
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
