<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TelefonoPersonaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idCodigoArea', EntityType::class, array(
                'class' => 'AppBundle\Entity\CodigoArea',
                'attr' => array('class' => 'form-control'),
                'label_attr' => array('class' => 'col-sm-1 control-label'),
                'label' => 'Código',
                'placeholder' => "Código",
                'required'      => false

            ))
            ->add('numero', TextType::class, array(
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
            'data_class' => 'AppBundle\Entity\TelefonoPersona'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_telefonopersona';
    }


}
