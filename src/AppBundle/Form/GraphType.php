<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class GraphType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class, array('label' => false ))
                ->add('yAxisTitle', TextType::class, array('label' => false ))
                ->add('xAxisTitle', TextType::class, array('label' => false ))
                ->add('xInterval', TextType::class, array('label' => false ))
                ->add('grouping', TextType::class, array('label' => false ))
                ->add('maximum', TextType::class, array('label' => false ))
                ->add('xLabelHeight', TextType::class, array('label' => false ))
                ->add('angle', TextType::class, array('label' => false ))
                ->add('groupAngle', TextType::class, array('label' => false ))
                ->add('graphGroups', TextType::class, array('label' => false ))
                ->add('showGroups', ChoiceType::class, array(
                    'label' => false,
                    'choices'  => array(
                        'Yes' => 'yes',
                        'No' => 'no',
                    ),
                ))
                ->add('showLabels', ChoiceType::class, array(
                    'label' => false,
                    'choices'  => array(
                        'Yes' => 'yes',
                        'No' => 'no',
                    ),
                ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Graph'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_graph';
    }


}
