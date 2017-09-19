<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SeccionComunidadType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class, array(
                'attr' => array('class' => 'form-control'),
                'label_attr' => array('class' => 'col-sm-3 control-label'),
                'label' => 'Nombre de la Comunidad'
            ))
            ->add('idSeccion', EntityType::class, array(
                'class' => 'AppBundle\Entity\Seccion',
                'attr' => array('class' => 'form-control'),
                'label_attr' => array('class' => 'col-sm-3 control-label'),
                'label' => 'Secciones NAI',
                'placeholder' => "Secciones Registradas",


            ))
            ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\SeccionComunidad'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_seccioncomunidad';
    }


}
