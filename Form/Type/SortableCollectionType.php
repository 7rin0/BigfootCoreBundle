<?php

namespace Bigfoot\Bundle\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Helper type allowing sorting of form types in collections.
 *
 * @package Bigfoot\Bundle\CoreBundle\Form\Type
 */
class SortableCollectionType extends AbstractType
{
    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'bigfoot_sortable_collection';
    }
}
