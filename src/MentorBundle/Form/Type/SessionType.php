<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 29/05/2017
 * Time: 12:55
 */

namespace MentorBundle\Form\Type;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'attr' => [
                    'class' => 'datepicker',
                    'data-provide' => 'datepicker',
                    'data-date-format' => 'dd-MM-yyyy'
                ]
            ))
            ->add('student', StudentType::class)
            ->add('project', EntityType::class, array(
                'class' => 'MentorBundle:Project',
                'choice_label' => 'name',
                'placeholder' => '-'
            ))
            ->add('type', ChoiceType::class, array(
                'choices' => array(
                    'Session' => 'session',
                    'Soutenance' => 'soutenance'
                )
            ))
            ->add('noshow', CheckboxType::class, array(
                'label' => 'No-show'
            ))
            ->add('price', IntegerType::class, array(
                'disabled' => true
            ));
    }
}
