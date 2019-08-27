<?php

namespace App\Form;

use App\Entity\Task;
use Makemewin\AppBundle\Form\SiteApiCredentialsConfigurationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskConfigurationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('parameter1', TextType::class, [
                'label'         => 'Parameter 1',
                'required'      => false,
                'property_path' => 'configuration[parameter1]',
                'attr'          => [
                    'class' => 'input',
                ],
            ])
            ->add('parameter2', TextType::class, [
                'label'         => 'Parameter 2',
                'required'      => false,
                'property_path' => 'configuration[parameter2]',
                'attr'          => [
                    'class' => 'input',
                ],
            ])
            ->add('parameter3-firstchild', TextType::class, [
                'label'         => 'Parameter 3: first child',
                'required'      => false,
                'property_path' => 'configuration[parameter3][firstchild]',
                'attr'          => [
                    'class' => 'input',
                ],
            ])
            ->add('parameter3-secondchild', TextType::class, [
                'label'         => 'Parameter 3: second child',
                'required'      => false,
                'property_path' => 'configuration[parameter3][secondchild]',
                'attr'          => [
                    'class' => 'input',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
