<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SeccionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->periodo = $options['periodo_activo'];
        $builder
            ->add('ofertaAcademica', EntityType::class, array(
                'class' => 'AppBundle\Entity\OfertaAcademica',
                'attr' => array('class' => 'form-control col-sm-12', 'data-select' => 'true'),
                'label_attr' => array('class' => 'col-sm-3 control-label'),
                'label' => 'Malla',
                'placeholder' => "Escribe el PFG que deses buscar",
                'group_by' => 'idOfertaMallaCurricular',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('o')
                        ->orderBy('o.id', 'ASC')
                        ->innerJoin('o.idOfertaMallaCurricular', 'm')
                        ->where('m.idPeriodo = ?1')
                        ->setParameters(array(
                            1 => $this->periodo
                            ,
                        ));
                },
            ))
            ->add('nombre', TextType::class, array(
                'attr' => array('class' => 'form-control'),
                'label_attr' => array('class' => 'col-sm-3 control-label'),
                'label' => 'Nombre de la Sección'
            ))
            ->add('aula', TextType::class, array(
                'attr' => array('class' => 'form-control'),
                'label_attr' => array('class' => 'col-sm-3 control-label'),
                'label' => 'Aula'
            ))
            ->add('cupo', TextType::class, array(
                'attr' => array('class' => 'form-control'),
                'label_attr' => array('class' => 'col-sm-3 control-label'),
                'label' => 'Cupos Disponibles'
            ))
            ->add('idTurno', EntityType::class, array(
                'class' => 'AppBundle\Entity\Turno',
                'attr' => array('class' => 'form-control'),
                'label_attr' => array('class' => 'col-sm-3 control-label'),
                'label' => 'Turno',
                'placeholder' => "Seleccione Turnos"

            ))
            ->add('idPersonaInstitucion', EntityType::class, array(
                'class' => 'AppBundle\Entity\PersonaInstitucion',
                'attr' => array('class' => 'form-control col-sm-12', 'data-select' => 'true'),
                'label_attr' => array('class' => 'col-sm-3 control-label'),
                'label' => 'Docente Asignado',
                'placeholder' => "Escriba el nombre del docente a buscar",
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('p')
                        ->orderBy('p.idPersona', 'ASC')
                        ->where('p.roles LIKE :roles')
                        ->setParameter('roles', '%"ROLE_DOCENTE"%'); //Que el usuario solo sea docente

                },

            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Seccion',
            'periodo_activo' => null

        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_seccion';
    }


}
