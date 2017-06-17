<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use \Symfony\Component\Form\Extension\Core\Type\SubmitType;
use \Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        $builder
                ->add('username')
                ->add('email')
                ->add('plainPassword', PasswordType::class, ['required' => false])
                ->add('roles', ChoiceType::class, array(
                    'required' => true,
                    'choices' => array('User' => 'ROLE_USER', 'Admin' => 'ROLE_ADMIN', 'Super Admin' => 'ROLE_SUPER_ADMIN'),
                    'multiple' => true,
                    'expanded' => true,
                    'label' => "Role ",
                    'label_attr' => array('class' => 'checkbox-inline')
                ))
                ->add('enabled')
                ->add('save', SubmitType::class)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'appbundle_user';
    }

}
