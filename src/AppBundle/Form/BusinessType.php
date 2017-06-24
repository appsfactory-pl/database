<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class BusinessType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name')
                ->add('address')
                ->add('postcode')
                ->add('doi', TextType::class, ['attr' => ['class' => 'span11', 'data-date-format' => "yyyy-mm-dd"]])
                ->add('cno')
                ->add('utr')
                ->add('vat')
                ->add('epaye')
                ->add('accoff')
                ->add('account')
                ->add('notes', TextareaType::class, ['attr' => ['class' => 'textarea_editor span12']])
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
