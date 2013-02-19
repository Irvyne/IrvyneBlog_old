<?php

namespace Irvyne\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content', 'ckeditor', array(
                'width'     => '100%',
                'height'    => '500',
            ))
            ->add('categories', null, array(
                'multiple'  => true,
                'expanded'  => true,
                'property'  => 'treeName',
            ))
            ->add('public', null, array(
                'required'  => false,
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Irvyne\BlogBundle\Entity\Article'
        ));
    }

    public function getName()
    {
        return 'irvyne_blogbundle_articletype';
    }
}
