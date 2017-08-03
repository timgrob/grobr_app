<?php

namespace XMasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use XMasBundle\Entity\Question;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('question', TextType::class, array(
                'disabled' => true
            ))
            ->add('answer1', TextType::class, array(
                'disabled' => true
            ))
            ->add('answer2', TextType::class)
            ->add('answer3', TextType::class)
            ->add('solution', ChoiceType::class, array(
                'choices' => array(
                    'Antwort 1' => 0,
                    'Antwort 2' => 1,
                    'Antwort 3' => 2
                )
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => Question::class
            )
        );
    }
}
