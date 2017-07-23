<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class BusinessType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('id2')
                ->add('legalForm')
                ->add('name')
                ->add('address')
                ->add('postcode')
                ->add('dateMovedIn', TextType::class, ['attr' => ['class' => 'span11', 'data-date-format' => "dd/mm/yyyy"]])
                ->add('doi', TextType::class, ['attr' => ['class' => 'span11', 'data-date-format' => "dd/mm/yyyy"]])
                ->add('doc', TextType::class, ['attr' => ['class' => 'span11', 'data-date-format' => "dd/mm/yyyy"]])
                ->add('betaPageLink')
                ->add('telephone')
                ->add('email')
                ->add('cno')
                ->add('utr')
                ->add('vat')
                ->add('epaye')
                ->add('accoff')
                ->add('accountsOffice')
                ->add('webfillingEmail', EmailType::class)
                ->add('webfillingPassword')
                ->add('authenticationCode')
                ->add('account')
                ->add('notes', TextareaType::class, ['attr' => ['class' => 'textarea_editor span12']])
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
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Business'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'appbundle_business';
    }

}
