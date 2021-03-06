<?php

namespace Bigfoot\Bundle\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Extends the TextareaType and adds the ckeditor class attribute.
 *
 * Class BigfootRichtextType
 * @package Bigfoot\Bundle\CoreBundle\Form\Type
 */
class BigfootRichtextType extends AbstractType
{
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'attr'  => array(
                    'class' => 'ckeditor'
                )
            )
        );
    }

    /**
     * @return null|string|\Symfony\Component\Form\FormTypeInterface
     */
    public function getParent()
    {
        return TextareaType::class;
    }
}
