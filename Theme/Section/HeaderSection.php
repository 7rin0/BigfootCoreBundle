<?php

namespace Bigfoot\Bundle\CoreBundle\Theme\Section;

/**
 * Class HeaderSection
 * @package Bigfoot\Bundle\CoreBundle\Theme\Section
 */
class HeaderSection extends AbstractSection
{
    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'header';
    }

    /**
     * @return mixed|void
     */
    protected function setDefaultParameters()
    {
    }
}
