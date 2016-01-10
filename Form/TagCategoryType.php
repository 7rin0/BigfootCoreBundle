<?php

namespace Bigfoot\Bundle\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class TagCategoryType
 * @package Bigfoot\Bundle\CoreBundle\Form
 */
class TagCategoryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('slug', TextType::class, array(
                'required' => false,
            ))
            ->add('translation', 'translatable_entity')
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bigfoot\Bundle\CoreBundle\Entity\TagCategory'
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'bigfoot_bundle_corebundle_tagcategorytype';
    }
}
