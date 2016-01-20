<?php

namespace Bigfoot\Bundle\CoreBundle\DataFixtures\ORM;

use Bigfoot\Bundle\CoreBundle\Entity\Widget as WidgetBackoffice;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadWidgetBackofficeData implements FixtureInterface
{
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