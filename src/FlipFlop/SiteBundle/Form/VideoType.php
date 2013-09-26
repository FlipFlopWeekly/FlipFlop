<?php

namespace FlipFlop\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('url')
            ->add('statut')
            ->add('newsletter')
            ->add('category')
            ->add('user')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FlipFlop\SiteBundle\Entity\Video'
        ));
    }

    public function getName()
    {
        return 'flipflop_sitebundle_video';
    }
}
