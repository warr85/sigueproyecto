<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonaFamiliarType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class, array(
                'label' => 'Nombre Familiar',
                'attr' => array('class' => 'form-control'),
                'label_attr' => array('class' => 'control-label'),

            ))
            ->add('idParentesco', EntityType::class, array(
                'label'         => 'Parentesco',
                'placeholder'   => 'Seleccione Parentesco',
                'class'         => 'AppBundle:Parentesco',
                'choice_label'  => 'getNombre',
                'required'      => false,
                'attr' => array('class' => 'form-control'),
                'label_attr' => array('class' => 'control-label'),
            ))
            ->add('jefeFamiliar', CheckboxType::class, array(
                'label' => '¿Es jefe de Familia?  ',
            ))
            ->add('idNivelInstruccion', EntityType::class, array(
                'label'         => 'Nivel de Instrucción',
                'placeholder'   => 'Seleccione Nivel',
                'class'         => 'AppBundle:NivelInstruccion',
                'choice_label'  => 'getNombre',
                'required'      => false,
                'attr' => array('class' => 'form-control'),
                'label_attr' => array('class' => 'control-label'),
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\PersonaFamiliar'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_personafamiliar';
    }


}
