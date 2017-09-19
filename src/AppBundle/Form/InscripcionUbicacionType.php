<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscripcionUbicacionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->id_seccion = $options['id_seccion'];
        $builder
            ->add('idSeccionComunidad', EntityType::class, array(
                'placeholder'   => 'Seleccione ubicación de la comunidad',
                'class'         => 'AppBundle\Entity\SeccionComunidad',
                'label'         => 'Comunidad NAI',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.id', 'ASC')
                        ->where('u.idSeccion = ?1') //que las comunidades coincidan con la seccion inscrita
                        ->setParameters(array(
                            1 => $this->id_seccion->getId(),
                        ));
                },
            ))
            ->add('nombreProyecto', TextType::class, array(
                'label'     => 'Nombre Proyecto'
            ))
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
            'id_seccion' => null,
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
