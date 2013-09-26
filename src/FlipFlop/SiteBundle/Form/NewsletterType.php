<?php

namespace FlipFlop\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewsletterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FlipFlop\SiteBundle\Entity\Newsletter'
        ));
    }

    public function getName()
    {
        return 'flipflop_sitebundle_newsletter';
    }
}
