<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 29/05/2017
 * Time: 12:55
 */

namespace MentorBundle\Form\Type;


use Doctrine\ORM\EntityManager;
use MentorBundle\Form\DataTransformer\DateTransformer;
use MentorBundle\Form\DataTransformer\StudentTransformer;
use MentorBundle\Form\EventListener\AddSessionListener;
use MentorBundle\Form\EventListener\AddSessionSubscriber;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolver;
use MentorBundle\Form\DataTransformer\StudentAutocompleteTranformer;
use MentorBundle\Entity\Session;

class SessionType extends AbstractType
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'html5' => false,
                'attr' => ['class' => 'js-datepicker'],
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
                'label' => 'No-show',
                'required' => false,
            ))
            ->add('price', NumberType::class, array(

            ));

        $builder->get('student')->addModelTransformer(new StudentAutocompleteTranformer($this->em));
        $builder->addEventSubscriber(new AddSessionListener($this->em));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Session::class
        ));
    }
}
