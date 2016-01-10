<?php

namespace Bigfoot\Bundle\CoreBundle\Theme\Section;

/**
 * Class FooterSection
 * @package Bigfoot\Bundle\CoreBundle\Theme\Section
 */
class FooterSection extends AbstractSection
{
    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'footer';
    }

    /**
     * @return mixed|void
     */
    protected function setDefaultParameters()
    {
    }
}
