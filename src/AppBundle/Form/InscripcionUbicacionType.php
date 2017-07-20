<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscripcionUbicacionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idSeccionComunidad', EntityType::class, array(
                'placeholder'   => 'Seleccione ubicación de la comunidad',
                'class'         => 'AppBundle\Entity\SeccionComunidad',
                'label'         => 'Comunidad del Núcleo de Investigación'
            ))
            ->add('nombreProyecto')
            ->add('comuna')
            ->add('consejoComunal')
            ->add('institucion')
            ->add('organizacionBase')
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\InscripcionUbicacion'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_inscripcionubicacion';
    }


}
