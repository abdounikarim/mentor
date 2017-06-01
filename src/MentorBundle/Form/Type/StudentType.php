<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 29/05/2017
 * Time: 16:35
 */

namespace MentorBundle\Form\Type;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class)
            ->add('name', TextType::class)
            ->add('path', EntityType::class, array(
                'class' => 'MentorBundle:Path',
                'choice_label' => 'name',
                'placeholder' => 'Sélectionnez un parcours'
            ));
    }
}
