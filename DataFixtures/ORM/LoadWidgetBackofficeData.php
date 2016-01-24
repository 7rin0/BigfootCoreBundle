<?php

namespace Bigfoot\Bundle\CoreBundle\DataFixtures\ORM;

use Bigfoot\Bundle\CoreBundle\Entity\Widget as WidgetBackoffice;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadWidgetBackofficeData
 *
 * @package Bigfoot\Bundle\CoreBundle\DataFixtures\ORM
 */
class LoadWidgetBackofficeData implements FixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 55;
    }
}