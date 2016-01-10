<?php

namespace Bigfoot\Bundle\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Extends the TextareaType and adds the ckeditor class attribute.
 *
 * Class BigfootRichtextType
 * @package Bigfoot\Bundle\CoreBundle\Form\Type
 */
class BigfootRichtextType extends AbstractType
{
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'attr'  => array(
                    'class' => 'ckeditor',
                )
            )
        );
    }

    /**
     * @return null|string|\Symfony\Component\Form\FormTypeInterface
     */
    public function getParent()
    {
        return 'textarea';
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getBlockPrefix()
    {
        return 'bigfoot_richtext';
    }
}
