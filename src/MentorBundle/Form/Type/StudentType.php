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
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', HiddenType::class)
            ->add('fullname', TextType::class, array(
                'help' => 'Prénom Nom'
            ))
            ->add('path', EntityType::class, array(
                'class' => 'MentorBundle:Path',
                'choice_label' => 'name',
                'placeholder' => '-',
                'disabled' => true
            ));
    }
}
