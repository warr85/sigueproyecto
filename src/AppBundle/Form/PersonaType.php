<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('primerNombre')->add('segundoNombre')->add('primerApellido')->add('segundoApellido')->add('cedulaPasaporte')->add('fechaNacimiento')->add('correoElectronico')->add('direccionResidencia')->add('fechaRegistro')->add('fechaActualizacion')->add('privadoLibertad')->add('certificadoConapdis')->add('idSucre')->add('idPaisNacimiento')->add('idNacionalidad')->add('idGenero')->add('idEstadoCivil')->add('idDocumentoentidad')->add('socioEconomico');
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
