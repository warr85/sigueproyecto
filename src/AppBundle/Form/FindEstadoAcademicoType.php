<?php
/**
 * Created by PhpStorm.
 * User: ubv-cipee
 * Date: 04/07/17
 * Time: 12:03 PM
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;


class FindEstadoAcademicoType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cedula', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Buscar'));
    }



}