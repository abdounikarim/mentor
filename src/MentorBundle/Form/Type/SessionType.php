<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 29/05/2017
 * Time: 12:55
 */

namespace MentorBundle\Form\Type;


use Doctrine\ORM\EntityManager;
use MentorBundle\Form\EventListener\AddSessionListener;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use MentorBundle\Form\DataTransformer\StudentAutocompleteTranformer;
use MentorBundle\Entity\Session;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Valid;

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
                'constraints' => new NotBlank()
            ))
            ->add('student', StudentType::class, array(
                'constraints' => new Valid()
            ))
            ->add('project', EntityType::class, array(
                'class' => 'MentorBundle:Project',
                'choice_label' => 'name',
                'placeholder' => '-',
                'constraints' => new NotBlank()
            ))
            ->add('type', ChoiceType::class, array(
                'choices' => array(
                    'Session' => 'Session',
                    'Soutenance' => 'Soutenance'
                ),
                'constraints' => new NotBlank()
            ))
            ->add('noshow', CheckboxType::class, array(
                'label' => 'No-show',
                'required' => false,
            ))
            ->add('price', MoneyType::class, array(
                'currency' => 'EUR',
                'constraints' => new NotBlank(),
                'attr' => array('readonly' => true)
            ));

        $builder->get('student')->addModelTransformer(new StudentAutocompleteTranformer($this->em));
        $builder->addEventSubscriber(new AddSessionListener($this->em));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Session::class,
            'cascade_validation' => true
        ));
    }
}
