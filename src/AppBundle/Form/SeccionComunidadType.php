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
                'label' => 'Nombre de la Sección'
            ))
            ->add('idSeccion', EntityType::class, array(
                'class' => 'AppBundle\Entity\Seccion',
                'attr' => array('class' => 'form-control col-sm-12', 'data-select' => 'true'),
                'label_attr' => array('class' => 'col-sm-3 control-label'),
                'label' => 'Malla',
                'placeholder' => "Escribe el PFG que deses buscar",
                'group_by' => 'ofertaAcademica',
                'multiple' => true
            ))

            ->add('idPersonaInstitucion', EntityType::class, array(
                'class' => 'AppBundle\Entity\PersonaInstitucion',
                'attr' => array('class' => 'form-control col-sm-12', 'data-combo' => 'true'),
                'label_attr' => array('class' => 'col-sm-3 control-label'),
                'label' => 'Docente Asignado',
                'placeholder' => "Escriba el nombre del docente a buscar",
                'multiple' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('p')
                        ->orderBy('p.idPersona', 'ASC')
                        ->where('p.roles LIKE :roles')
                        ->setParameter('roles', '%"ROLE_DOCENTE"%'); //Que el usuario solo sea docente

                },

            ))
            ->add('ubicacion', TextType::class, array(
                'attr' => array('class' => 'form-control coordenadas'),
                'label_attr' => array('class' => 'col-sm-3 control-label'),
                'label' => 'coordenadas de la comunidad'
            ));
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
