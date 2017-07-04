<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscripcionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->estado_academico = $options['estado_academico'];
        if (count($this->estado_academico->getHasInscripcion()) == 0){
            $tray = 1;
            $tram = 1;
        }

        $builder
            ->add('idSeccion', EntityType::class, array(
                'class' => 'AppBundle:OfertaAcademica',
                'expanded'  => true,
                'multiple'  => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.idMallaCurricularUc', 'ASC')
                        ->innerJoin('u.idMallaCurricularUc', 'm', 'WITH', 'm.idTrayectoTramoModalidadTipoUc = ?2')
                        ->where('u.idOfertaMallaCurricular = ?1') //que las uc conicidan con la malla del estado academico
                        ->setParameters(array(
                            1 => $this->estado_academico->getIdMallaCurricular(),
                            2 => 1,
                        ));
                    },

            ))

        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(

            'estado_academico' => null,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_inscripcion';
    }


}
