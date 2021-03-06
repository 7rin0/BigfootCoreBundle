<?php

namespace Bigfoot\Bundle\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Helper type allowing custom display of form types in collections.
 *
 * Meant to be used on types used as embedded forms in collections : adds a "Delete" link if allow_delete is set and adds the necessary HTML structure to make the form appear inside a collapsable element.
 *
 * @package Bigfoot\Bundle\CoreBundle\Form\Type
 */
class FileType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (!isset($options['filePathProperty']) || !$options['filePathProperty']) {
            throw new \Exception('BigfootFileType needs the options filePathProperty to be defined');
        }
        $builder
            ->setAttribute('filePathProperty', $options['filePathProperty'])
            ->setAttribute('deleteRoute', $options['deleteRoute'])
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['filePathProperty'] = $options['filePathProperty'];
        $view->vars['deleteRoute'] = $options['deleteRoute'];
    }

    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'filePathProperty' => '',
            'deleteRoute' => '',
        ));
    }

    /**
     * @return string
     */
    public function getParent()
    {
        return FileType::class;
    }
}
