<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonaVotacionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cne', CheckboxType::class, array(
                'label' => '¿Inscrito CNE?',
                'label_attr' => array('class' => 'col-sm-3 control-label'),
                'mapped' => false
            ))

            ->add('idCentroVotacion', EntityType::class, array(
            'class' => 'AppBundle\Entity\CentroVotacion',
            'attr' => array('class' => 'form-control'),
            'label' => 'Votación',
            'label_attr' => array('class' => 'col-sm-3 control-label'),
            'placeholder' => "¿Donde Vota?"
        ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\PersonaVotacion'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_personavotacion';
    }


}
