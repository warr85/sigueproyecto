<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idPaisNacimiento', EntityType::class, array(
                'class' => 'AppBundle\Entity\PaisNacimiento',
                'attr' => array('class' => 'form-control'),
                'label_attr' => array('class' => 'col-sm-3 control-label'),
                'label' => 'Pais',
                'placeholder' => "País de Nacimiento"

            ))
            ->add('idGenero', EntityType::class, array(
                'class' => 'AppBundle\Entity\Genero',
                'attr' => array('class' => 'form-control'),
                'label_attr' => array('class' => 'col-sm-3 control-label'),
                'label' => 'Genero',
                'placeholder' => "Seleccione Género"

            ))

            ->add('cedulaPasaporte', TextType::class, array(
                'attr' => array('class' => 'form-control'),
                'label_attr' => array('class' => 'col-sm-3 control-label'),
                'label' => 'Cédula'
            ))
            ->add('primerNombre', TextType::class, array(
                'attr' => array('class' => 'form-control'),
                'label_attr' => array('class' => 'col-sm-3 control-label'),
            ))
            ->add('segundoNombre', TextType::class, array(
                'attr' => array('class' => 'form-control'),
                'label_attr' => array('class' => 'col-sm-3 control-label'),
            ))
            ->add('primerApellido', TextType::class, array(
                'attr' => array('class' => 'form-control'),
                'label_attr' => array('class' => 'col-sm-3 control-label'),
            ))
            ->add('segundoApellido', TextType::class, array(
                'attr' => array('class' => 'form-control'),
                'label_attr' => array('class' => 'col-sm-3 control-label'),
            ))
            ->add('fechaNacimiento', BirthdayType::class, array(
                'attr' => array('class' => ''),
                'label_attr' => array('class' => 'col-sm-3 control-label'),
                'label' => 'F.Nac:'
            ))
            ->add('correoElectronico', EmailType::class, array(
                'attr' => array('class' => 'form-control'),
                'label_attr' => array('class' => 'col-sm-3 control-label'),
                'label' => 'Email:'
            ))
            ->add('direccionResidencia', TextareaType::class, array(
                'attr' => array('class' => 'form-control'),
                'label_attr' => array('class' => 'col-sm-3 control-label'),
                'label' => 'Dirección:'
            ))
            ->add('privadoLibertad', CheckboxType::class, array(
                'label' => '¿Privado de libertad?',

            ))


            ->add('idEstadoCivil', EntityType::class, array(
                'class' => 'AppBundle\Entity\EstadoCivil',
                'attr' => array('class' => 'form-control'),
                'label_attr' => array('class' => 'col-sm-3 control-label'),
                'label' => 'Genero',
                'placeholder' => "Estado Civil"

            ))
            ->add('idDocumentoentidad', EntityType::class, array(
                'class' => 'AppBundle\Entity\DocumentoIdentidad',
                'attr' => array('class' => 'form-control'),
                'label_attr' => array('class' => 'col-sm-3 control-label'),
                'label' => 'Genero',
                'placeholder' => "Tipo de Documento"

            ))
            ->add('familiares', CollectionType::class, array(
                'label' => false,
                'entry_type'   => PersonaFamiliarType::class,
                'allow_add'    => true,
            ))
            ->add('misiones', CollectionType::class, array(
                'label' => false,
                'entry_type'   => PersonaMisionType::class,
                'allow_add'    => true,
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Persona'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_persona';
    }


}
