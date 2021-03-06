<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class PersonaInstitucionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idInstitucion', EntityType::class, array(
                'class' => 'AppBundle\Entity\Institucion',
                'attr' => array('class' => 'form-control'),
                'label' => 'Sede',
                'placeholder' => "Seleccione Eje"

            ))
            ->add('estados_academicos', CollectionType::class, array(
                'entry_type'   => EstadoAcademicoType::class,
                'allow_add'    => true,
                'label' => false
            ))
            ->add('roles', ChoiceType::class, array(
                'choices'  => array(
                    'ROLE_ESTUDIANTE' => 'Estudiante',
                    'ROLE_DOCENTE' => 'Docente',
                    'ROLE_ADMINISTRADOR' => 'Administrador',
                ),
                'label' => '¿Que Rol tiene la persona?',
                'choice_attr' => function($val, $key, $index) {
                    // adds a class like attending_yes, attending_no, etc
                    return ['class' => 'checkbox-inline'];
                },
                'multiple' => true,
                'expanded' => true
            ))
         ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\PersonaInstitucion'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_personainstitucion';
    }


}
